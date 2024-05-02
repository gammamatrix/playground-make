<?php
/**
 * Playground
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Model Language Lines
    |--------------------------------------------------------------------------
    |
    |
    */

    'Create.primary.unexpected' => 'Unexpected type [INVALID: :primary] column - allowed: :allowed',
    'CreateColumn.type.unexpected' => 'Unexpected type [:type] for column [:column] - allowed: :allowed',

    'Attributes.invalid' => 'Adding an attribute to [:name] requires a column [:column] to be provided.',
    'Casts.invalid' => 'Adding a cast to [:name] requires a column [:column] to be provided.',
    'Fillable.invalid' => 'Adding a fillable column to [:name] requires a column [:column] to be provided.',

    'HasOne.invalid' => 'Adding a HasOne to [:name] requires an accessor [:accessor] to be provided.',
    'HasMany.invalid' => 'Adding a HasMany to [:name] requires an accessor [:accessor] to be provided.',

    'Scope.invalid' => 'Adding a Scope to [:name] requires a scope [:scope] to be provided.',
    'Scope.ignored' => 'Adding a Scope to [:name] is limited to [sort] at this time.',

    'Sorting.invalid' => 'Adding a sortable column to [:name] requires a column [:column] to be provided - index[:i]',

];
