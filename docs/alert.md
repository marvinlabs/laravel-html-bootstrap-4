# Alerts

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/alerts/)

## Basic usage

```$php
@component('bs::alert', ['type' => 'danger'])
    A simple alert of danger type
@endcomponent
```

```$php
@component('bs::alert', ['type' => 'success'])
    This is a primary alert with <a href="#" class="alert-link">an example link</a>. Give it a 
    click if you like.
@endcomponent
```

```$php
@component('bs::alert', ['type' => 'info', 'animated' => true, 'dismissible' => true])
    Animated alert, and dismissible
@endcomponent
```

```$php
@component('bs::alert', ['type' => 'dark'])
    @slot('heading')
        An alert with heading
    @endslot
   
    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit
       longer so that you can see how spacing within an alert works with this kind of content.</p>
    <hr>
    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
@endcomponent
```

```$php
@component('bs::alert', ['type' => 'warning', 'data' => ['alert-id' => 40, 'context' => 'sample-code']])
    An alert with some data attributes
@endcomponent
```



