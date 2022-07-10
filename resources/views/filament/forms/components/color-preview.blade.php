<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{ state: $wire.entangle('data') }">
        <span x-text="state.title"
              class="rounded text-xs px-2 py-1"
              :style="{ 'color': state.color, 'background-color': state.bgcolor, 'border': '1px solid ' + state.bordercolor }"></span>
    </div>
</x-forms::field-wrapper>
