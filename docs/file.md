# Files

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/forms/#file-browser)

Remember to open the form using the `'files' => true` option. Else your files will not be 
submitted.

## Custom file control

By default, we output custom file controls. Which has its own problems though.

Here is a quote from the bootstrap documentation:

> The file input is the most gnarly of the bunch and requires additional JavaScript if you’d like to hook them up 
> with functional Choose file… and selected file name text.

```$php
{{ bs()->file('avatar2', 'Select a file') }}
```

## Default file control

But you can also insert default file inputs too. Those ones are ugly but properly show the 
selected file name.

```$php
{{ bs()->simpleFile('avatar') }}
```

## Wrapped inside a form group

It can be wrapped inside a form group if needed.

```$php
{{ bs()->formGroup()
       ->label('Username')
       ->control(bs()->file('avatar2', 'Pick a file')) }}
```


