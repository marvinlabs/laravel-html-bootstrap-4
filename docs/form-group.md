# Form groups

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/forms/#form-groups)

Form groups are used to structure the form and display field errors automatically under 
the field.

## Basic usage

```$php
{{ bs()->formGroup()
       ->label('This is the label of the control')
       ->control(bs()->text('first_name')->placeholder('I am the form group control'))
       ->helpText('This is the help text of the form group') }}
```

## Calling methods of the wrapped control

You may need to call methods on the control that gets wrapped by the form group. You can 
do that without breaking the call chain by prefixing the method name by `control`. 

For example, to disable the control (`disabled` method), you would call the `controlDisabled` 
function on the group. Here are the rules:

- `group->controlMyMethod()` &rarr; `group->control->myMethod()` (eg. `disabled()`)
- `group->addControlMethod()` &rarr; `group->control->addMethod()` (eg. `addClass()`)
- `group->forgetControlMethod()` &rarr; `group->control->forgetMethod()` (eg. `forgetAttribute()`)

```$php
{{ bs()->formGroup()
       ->label('This is the label of the control')
       ->control(bs()->text('first_name')->placeholder('I am the form group control'))
       ->helpText('This is the help text of the form group')
       ->controlDisabled() }}
```

