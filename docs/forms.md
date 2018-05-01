# Forms

## Open a form

Simply open a form on the /user URL with POST method.

```$php
{{ bs()->openForm('post', '/user') }}
```

Do not forget to close it when you are done!

```$php
{{ bs()->closeForm() }}
```

### Open options

The 3rd parameter of the `openForm` function accepts some options. 

```$php
{{ bs()->openForm('post', '/user', [ /* Your options here */ ]) }}
```

#### Files

If you have file input fields inside the form, make sure to set the `files` option
to true. This will generate the `enctype` HTML attribute. 

```$php
'files' => true
```

#### Model binding

This will automatically populate fields from the corresponding model properties.

For instance, if the form is bound to `$user`, a field with name `username` would 
be populated from the attribute `$user->username`.

```$php
'model' => $user
```

For instance:

```$php
{{ bs()->openForm('post', '/user', ['model' => $user]) }}
{{   bs()->text('username') }}
{{ bs()->closeForm() }}
```

#### Hiding errors

If you are displaying the validation errors by yourself, you may want to disable the 
messages which get inserted below each form field.

```$php
'hideErrors' => true
```

#### Inline forms

You can generate inline forms as described on the 
[Bootstrap documentation](https://getbootstrap.com/docs/4.0/components/forms/#inline-forms). 
Just enable that option.

```$php
'inline' => true
```

#### Additional attributes

You can set additional attributes on the opened form tag. Just pass them as an associative
array.

```$php
'attributes' => [
    'id'       => 'create_user_form',
    'v-cloack' => '',
]
```
