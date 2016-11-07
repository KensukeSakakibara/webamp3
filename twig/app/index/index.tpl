{% extends "app/layout.tpl" %}

{% block content %}
    <h1>WEBAMP 3</h1>
    
    {% if name is not null %}
        <h2>Hello {{name}}!</h2>
    {% else %}
        <p>Try <a href="http://www.slimframework.com">SlimFramework</a>
    {% endif %}
{% endblock %}