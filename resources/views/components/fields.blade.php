@props([
    'atts' => [],
    'class' => null,
    'cols' => 1,
    'cols_md' => null,
    'cols_lg' => null,
    'cols_xl' => null,
    'gap' => 3,
    'fields' => [],
])
<div
    {{ $attributes->merge(
        array_merge(
            [
                'class' => css_classes([
                    'grid',
                    "grid-cols-$cols" => $cols,
                    "md:grid-cols-$cols_md" => $cols_md,
                    "lg:grid-cols-$cols_lg" => $cols_lg,
                    "xl:grid-cols-$cols_xl" => $cols_xl,
                    "gap-$gap" => $gap,
                    $class => $class,
                ]),
            ],
            $atts,
        ),
    ) }}>
    @foreach ($fields as $field)
        <div class="col">
            @component('components.form.field', $field)
            @endcomponent
        </div>
    @endforeach
</div>
