# Radio groups

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/forms/#checkboxes-and-radios-1)

## Basic usage

```$php
{{ bs()->radioGroup('agree_terms_0', [
                  'y' => 'I am interested!',
                  'n' => 'No, thanks.',
              ]) }}
```

```$php
{{ bs()->radioGroup('agree_terms_1', [
                  'y' => 'I am interested!',
                  'n' => 'No, thanks.',
              ], 'y') }}
```

```$php
{{ bs()->radioGroup('agree_terms_2', [
           'y' => 'I am interested!',
           'n' => 'No, thanks.',
       ])
       ->selectedOption('y') }}
```

## HTML description

```$php
{{ bs()->radio('i_am')
       ->description('I am a <a href="#">human</a>') }}
```

## Wrapped inside a form group

It can be wrapped inside a form group if needed (to show errors for instance).

```$php
{{ bs()->formGroup()
       ->label('Please select an option', true)
       ->control(bs()->radioGroup('agree_terms', [
               'y' => 'I am interested!',
               'n' => 'No, thanks.',
           ], 'y'))
       ->helpText('This is the help text of the radio group') }}
```


