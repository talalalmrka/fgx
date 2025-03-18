@props([
    'id' => uniqid('textarea-'),
    'icon' => null,
    'label' => null,
    'value' => '',
    'error' => null,
    'placeholder' => null,
    'autofocus' => false,
    'autocomplete' => null,
    'required' => false,
    'disabled' => false,
    'rounded' => 'lg',
    'info' => null,
    'size' => 'normal',
    'rows' => 5,
    's' => [],
    'class' => null,
    'atts' => [],
    'directionButtons' => false,
])
@php
    $error = $error ?? $errors->has($id);
@endphp

<x-fgx::label :for="$id" :icon="$icon" :required="$required" :error="$error" :label="$label" />
@if ($directionButtons)
    <div id="{{ $id }}-container" x-data="textareaDirection" class="relative overflow-hidden rounded-lg">
        <div x-bind="toolbar">
            <button x-bind="ltrButton" type="button">
                @icon('bi-text-left')
            </button>
            <button x-bind="rtlButton" type="button">
                @icon('bi-text-right')
            </button>
        </div>
        <textarea x-bind="textarea" {!! $attributes->merge(
            array_merge($atts, [
                'id' => $id,
                'rows' => $rows,
                'placeholder' => $placeholder,
                'autofocus' => $autofocus ? '' : null,
                'required' => $required ? '' : null,
                'disabled' => $disabled ? '' : null,
                'aria-describedby' => $info ? $id . '-help' : null,
                'class' => css_classes(['form-control', 'error' => $error, $class => $class]),
            ]),
        ) !!}>{{ $value }}</textarea>
    </div>
@else
    <textarea {!! $attributes->merge(
        array_merge($atts, [
            'id' => $id,
            'rows' => $rows,
            'placeholder' => $placeholder,
            'autofocus' => $autofocus ? '' : null,
            'required' => $required ? '' : null,
            'disabled' => $disabled ? '' : null,
            'aria-describedby' => $info ? $id . '-help' : null,
            'class' => css_classes(['form-control', 'error' => $error, $class => $class]),
        ]),
    ) !!}>{{ $value }}</textarea>
@endif
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />
@if ($directionButtons)
    @pushOnce('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('textareaDirection', () => ({

                    direction: '',
                    textareaEl: {},
                    textareaPaddingTop: null,
                    textareaId: null,
                    toolbar: {
                        ['x-ref']: 'toolbar',
                        [':class']() {
                            return {
                                'flex-space-1 p-1 bg-gray-300 dark:bg-gray-600 text-xs absolute inset-x-[1px] top-[1px] rounded-t-lg': true,
                            };

                        },
                    },
                    buttonClasses: {
                        'flex items-center text-gray-700 dark:text-white rounded p-[0.2rem] hover:bg-gray-400 dark:hover:bg-gray-700': true,
                    },
                    rtlButton: {
                        [':class']() {
                            return {
                                ...this.buttonClasses,
                                ...{
                                    'bg-primary text-white': this.direction == 'rtl',
                                }
                            };
                        },
                        ['@click']() {
                            this.toggle('rtl');
                        }
                    },
                    ltrButton: {
                        [':class']() {
                            return {
                                ...this.buttonClasses,
                                ...{
                                    'bg-primary text-white': this.direction == 'ltr',
                                }
                            };
                        },
                        ['@click']() {
                            this.toggle('ltr');
                        }
                    },
                    textarea: {
                        ['x-ref']: 'textarea',
                        [':style']() {
                            return {
                                'direction': this.direction,
                                'paddingTop': this.textareaPaddingTop,
                            };
                        },
                    },
                    initTextareaPaddingTop() {
                        const element = document.getElementById(this.textareaId);
                        const computedStyle = window.getComputedStyle(element);
                        const textareaOlPaddingTop = computedStyle.paddingTop;
                        let toolbarHeight = this.$refs.toolbar.offsetHeight;
                        this.textareaPaddingTop = `calc(${textareaOlPaddingTop} + ${toolbarHeight}px)`;
                    },
                    saveDirection() {
                        if (this.textareaId !== undefined) {
                            const dirId = `${this.textareaId}_direction`;
                            localStorage.setItem(dirId, this.direction);
                        }
                    },
                    loadSavedDirection() {
                        if (this.textareaId !== undefined) {
                            const dirId = `${this.textareaId}_direction`;
                            const savedDirection = localStorage.getItem(dirId);
                            if (savedDirection !== undefined) {
                                this.direction = savedDirection;
                            }
                        }
                    },
                    toggle(dir) {
                        this.direction = dir;
                        this.saveDirection();
                    },
                    init() {
                        this.$nextTick(() => {
                            this.textareaEl = this.$refs.textarea;
                            this.textareaId = this.textareaEl.id;
                            this.loadSavedDirection();
                            this.initTextareaPaddingTop();
                        });
                    },
                }));
            });
        </script>
    @endPushOnce
@endif
