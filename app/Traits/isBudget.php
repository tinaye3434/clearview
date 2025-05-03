<?php

namespace App\Traits;

use App\Models\FundingRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\ModelInfo\ModelInfo;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Jantinnerezo\LivewireAlert\Enums\Position;

trait isBudget
{

//    use LivewireAlert;
    public $id;
//    public $model_class;
//    public ReportList $report;
//    public ReportSubmission $submission;
//    public $reports_list = [];



    public $model_info;

    public array $populate_array = [];
    public array $entries = [];
    public $class;
    public array $fields;
    public array $fields_to_create = [];
    public array $fields_to_exclude = ['created_at', 'updated_at'];
    public string|null $error = NULL;

    public function populate(): void
    {
        $this->entries[] = $this->populate_array;
        $this->dispatch('populated');
    }

    public function remove($key): void
    {
        if(isset($this->entries[$key]['id']) && $this->entries[$key]['id'] != 0){
            $this->class->where('id', $this->entries[$key]['id'])->delete();

            $this->dispatch('removed');

        }

        unset($this->entries[$key]);
    }

    public function updateTotal($key): void
    {
        $this->entries[$key]['total_cost'] = (int)$this->entries[$key]['quantity'] * (int)$this->entries[$key]['unit_cost'];
    }

    public function save(): void
    {
        $total_cost = 0;
        foreach ($this->entries as $key => $entry) {

            if($this->checkInputs($entry)){

                $this->alert('error', $this->error ?? 'Please FIll In Required Fields', [
                    'position' => 'center'
                ]);

                continue;

            }

            $model = new $this->class;

            if($entry['id'] == "" | $entry['id'] == 0 ){

                $created = $model->create($entry);
                $total_cost += $created->total_cost;

                $this->entries[$key]['id'] = $created->id;
            } else  {

                $id = $entry['id'];

                $model->where(function (Builder $query) use ($id) {
                    $query->where('id', $id);
                })->where('id', $id)->update($entry);

                $total_cost += $entry['total_cost'];
            }

            $request = FundingRequest::find($entry['funding_request_id']);
            $request->update([
                'target_amount' => $total_cost,
            ]);

            if(isset($this->fields_to_create)){
                foreach ($this->fields_to_create as $field) {
                    $fieldModel = ModelInfo::forModel('App\Models\\'. $field['class']);
                    $fieldClass = new $fieldModel->class;
                    $data = [];

                    foreach ($field['match'] as $field_name =>$item) {
                        $data[$item] = $entry[$field_name];
                    }

                    $fieldClass->where(function (Builder $query) use ($field, $entry) {

                        foreach($field['filter'] as $field_name => $item) {
                            $query->where($item , $entry[$field_name]);
                        }
                    });

                    $fieldClass->create($data);
                }
            }

            LivewireAlert::title('Success')
                ->text('Operation completed successfully.')
                ->position('center')
                ->success()
                ->timer(3000)
                ->show();

//            $this->alert('success', 'Created Records successfully!', [
//                'position' => 'center'
//            ]);

        }
    }

    public function setVariables(): void
    {
        try {
//            $this->reports_list = $this->submission->reports;

            $modelInfo = ModelInfo::forModel('App\Models\BudgetItem');
            $this->class = new $modelInfo->class;
            $attributes = $modelInfo->attributes->where('cast', '!=', 'accessor');


            $exclude = array_merge($this->fields_to_exclude, $modelInfo->extra ?? []);
            $this->fields = array_diff($attributes->pluck('name')->toArray(), $exclude);

            $this->populate_array = $this->populateDefaults($attributes);

            $this->model_info = (object) [
                'name' => Str::title(Str::replace('_', ' ', $modelInfo->tableName)),
                'class' => $modelInfo->class,
            ];


            $records = $this->class->select($this->fields)
                ->where('funding_request_id', $this->fundingRequest->id)
                ->get()
                ->toArray();


            $this->entries = array_map(function ($record) use ($modelInfo) {
                foreach ($modelInfo->extra ?? [] as $item) {
                    unset($record[$item]);
                }
                return $record;
            }, $records);

        } catch (Exception $e) {
            dd($e);
        }
    }

    private function populateDefaults($attributes)
    {
        $populate_array = [];

        foreach ($attributes as $attribute) {
            switch ($attribute->name) {
                case 'funding_request_id':
                    $populate_array['funding_request_id'] = $this->fundingRequest->id;
                    break;
                case 'status':
                    $populate_array['status'] = true;
                    break;
                default:
                    $populate_array = $this->populateDefaultByType($attribute, $populate_array);
                    break;
            }
        }
        return $populate_array;
    }

    private function populateDefaultByType($attribute, $populate_array)
    {
        switch ($attribute->type) {
            case 'date':
                $populate_array[$attribute->name] = Carbon::now()->toDateString();
                break;
            case 'datetime':
                $populate_array[$attribute->name] = Carbon::now();
                break;
            case 'text':
                $populate_array[$attribute->name] = '';
                break;
            case (Str::contains($attribute->type, 'bigint') || Str::contains($attribute->type, 'int') ||
                Str::contains($attribute->type, 'double' ) ):
                $populate_array[$attribute->name] = 0;
                break;
            case (Str::contains($attribute->type, 'varchar') || Str::contains($attribute->type, 'enum')):
                $populate_array[$attribute->name] = "";
                break;
        }

        return $populate_array;
    }


    public function checkInputs($entry): bool
    {
        return false;
    }

    public function rendered(){
        $this->dispatch('rendered');
    }

    public function hydrate()
    {
        $this->dispatch('hydrated');

    }

}
