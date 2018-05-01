# Forms

## Open a form

Simply open a form on the /user URL with POST method. Do not forget to close it when 
you are done!

```
{{ bs()->openForm('post', '/user') }}
  {{-- Your form content here --}}
{{ bs()->closeForm() }}
```

## Form errors

Form errors will automatically be displayed below the field they relate to, provided 
the field is wrapped into a form group.

## Open options

The 3rd parameter of the `openForm` function accepts some options. 

```
{{ bs()->openForm('post', '/user', [ /* Your options here */ ]) }}
  {{-- Your form content here --}}
{{ bs()->closeForm() }}
```

### Files

If you have file input fields inside the form, make sure to set the `files` option
to true. This will generate the `enctype` HTML attribute. 

```
'files' => true
```

### Model binding

This will automatically populate fields from the corresponding model properties.

For instance, if the form is bound to `$user`, a field with name `username` would 
be populated from the attribute `$user->username`.

```
'model' => $user
```

For instance:

```$php
{{ bs()->openForm('post', '#', ['model' => $user]) }}
{{   bs()->text('name') }}
{{ bs()->closeForm() }}
```

### Hiding errors

If you are displaying the validation errors by yourself, you may want to disable the 
messages which get inserted below each form field.

```
'hideErrors' => true
```

### Inline forms

You can generate inline forms as described on the 
[Bootstrap documentation](https://getbootstrap.com/docs/4.0/components/forms/#inline-forms). 
Just enable that option.

```
'inline' => true
```

For instance:

```$php
{{ bs()->openForm('post', '#', ['inline' => true]) }}
{{   bs()->text('username')->placeholder('Username')->addClass('mr-2') }}
{{   bs()->text('password')->placeholder('Password')->addClass('mr-2') }}
{{   bs()->submit('Login') }}
{{ bs()->closeForm() }}
```

### Additional attributes

You can set additional attributes on the opened form tag. Just pass them as an associative
array.

```
'attributes' => [
    'id'       => 'create_user_form',
    'v-cloack' => '',
]
```

## Horizontal forms

Labels can be placed on the left side, instead of above the controls. You should use
form groups to layout the labels.

Then you can either use pre-defined row configurations (using the `showAsRow` function), 
or build the rows by yourself by adding the appropriate column classes to the label and 
wrapping the control inside a div with column classes (using the `wrapControlIn` function).

Here is a sample form.

```$php
{{ bs()->openForm('put', '#') }}

{{-- Manually create a row (using "wrapControlIn") --}}
{{ bs()->formGroup()
       ->label('First name', false, ['col-sm-2'])
       ->control(bs()->text('first_name', 'John'))
       ->wrapControlIn(bs()->div()->addClass('col-sm-10'))
       ->addClass('row')}}

{{-- Create a row using the default configuration entry: config('bs4.form_rows.default') --}}
{{ bs()->formGroup()
       ->control(bs()->inputGroup(bs()->text('username', 'johndoe'), '@'))
       ->label('Username', false)
       ->helpText('Your username here')
       ->showAsRow() }}

{{-- Create a row using a custom configuration entry: config('bs4.form_rows.no_label') --}}
{{ bs()->formGroup()
       ->control(bs()->checkBox('remember2', 'Remember me'))
       ->helpText('This is the checkbox control help text...')
       ->showAsRow('no_label') }}

{{ bs()->formGroup()
       ->control(bs()->submit('Submit', 'secondary')
                     ->child(fa()->icon('send')->addClass('ml-2')))
       ->showAsRow('no_label')}}

{{ bs()->closeForm() }}
```
