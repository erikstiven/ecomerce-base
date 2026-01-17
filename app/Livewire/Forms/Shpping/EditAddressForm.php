<?php

namespace App\Livewire\Forms\Shpping;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditAddressForm extends Form
{
    //id
    public $id;
    public $type = '';
    public $description = '';
    public $province = '';
    public $city = '';
    public $reference = '';
    //receiver
    public $receiver = 1;
    //receiver_info
    public $receiver_info = [];
    //default
    public $default = false;

    public function rules()
    {
        $provinces = $this->provinceOptions();
        $cities = $this->cityOptions($this->province);

        return [
            'type' => 'required|in:1,2',
            'description' => 'required|string',
            'province' => ['required', 'string', Rule::in($provinces)],
            'city' => ['required', 'string', Rule::in($cities)],
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info.name' => 'required|string',
            'receiver_info.last_name' => 'required|string',
            'receiver_info.document_type' => [
                'required',
                new Enum(TypeOfDocuments::class),
            ],
            'receiver_info.document_number' => 'required|string',
            'receiver_info.phone' => 'required|string',
        ];
    }

    //traducir errors
    public function validationAttributes()
    {
        return [
            'type' => 'tipo de dirección',
            'description' => 'nombre de la dirección',
            'province' => 'provincia',
            'city' => 'ciudad',
            'reference' => 'referencia',
            'receiver_info.name' => 'nombres del receptor',
            'receiver_info.last_name' => 'apellidos del receptor',
            'receiver_info.document_type' => 'tipo de documento del receptor',
            'receiver_info.document_number' => 'número de documento del receptor',
            'receiver_info.phone' => 'teléfono del receptor',
        ];
    }

    public function messages()
    {
        return [
            'province.in' => 'Selecciona una provincia válida de Ecuador.',
            'city.in' => 'Selecciona una ciudad válida para la provincia elegida.',
        ];
    }

    //metodo edit
    public function edit($address)
    {
        $this->id = $address->id;
        $this->type = $address->type;
        $this->description = $address->description;
        $this->province = $this->normalizeText($address->province);
        $this->city = $this->normalizeText($address->city);
        $this->reference = $address->reference;
        $this->receiver = $address->receiver;
        $this->receiver_info = $address->receiver_info;
        $this->default = $address->default;
    }

    //update
    public function update()
    {
        $this->validate();
        
        $address = Address::find($this->id);
        $address->update([
            'type' => $this->type,
            'description' => $this->description,
            'province' => $this->normalizeText($this->province),
            'city' => $this->normalizeText($this->city),
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,
        ]);

        // Reset the form
        $this->reset();
    }

    private function provinceOptions(): array
    {
        return array_keys(config('ecuador.provinces', []));
    }

    private function cityOptions(?string $province): array
    {
        if (!$province) {
            return [];
        }

        $provinceData = config('ecuador.provinces', [])[$province] ?? null;
        if (!$provinceData) {
            return [];
        }

        return $provinceData['cities'] ?? [];
    }

    private function normalizeText(?string $value): string
    {
        return mb_strtolower(trim((string) $value));
    }
}
