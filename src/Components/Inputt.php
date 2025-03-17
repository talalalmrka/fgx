<?php

namespace Fgx\Components;

use Illuminate\View\Component;

class Inputt extends Component
{
    public string $id;
    public string $type;
    public string $name = '';
    public string $label;
    public ?string $icon;
    public ?string $startIcon;
    public ?string $endIcon;
    public ?string $value;
    public ?string $info;
    public ?string $placeholder;
    public bool $required;
    public bool $autofocus;
    public ?string $autocomplete;
    public ?string $error;
    public ?string $class;
    public array $atts;


    public function __construct(
        string $id = '',
        string $type = 'text',
        string $name = '',
        string $label = '',
        ?string $icon = null,
        ?string $startIcon = null,
        ?string $endIcon = null,
        ?string $value = null,
        ?string $info = null,
        ?string $placeholder = null,
        bool $required = false,
        bool $autofocus = false,
        ?string $autocomplete = null,
        ?string $error = null,
        ?string $class = null,
        array $atts = [],
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->startIcon = $startIcon;
        $this->endIcon = $endIcon;
        $this->value = $value;
        $this->info = $info;
        $this->placeholder = $placeholder ?? $label;
        $this->required = $required;
        $this->autofocus = $autofocus;
        $this->autocomplete = $autocomplete;
        $this->error = $error ?? $this->getError($id);
        $this->class = $class;
        $this->atts = $atts;
    }

    public function render()
    {
        return view('fgx::components.input');
    }

    protected function getError(string $id): ?string
    {
        $errors = session()->get('errors');

        return $errors
            ? $errors->first($id)
            : null;
    }

    public function hasError(): bool
    {
        return !empty($this->error);
    }
}