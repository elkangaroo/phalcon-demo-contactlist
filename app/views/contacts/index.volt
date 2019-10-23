<h1>
	You have {{ contacts.count() }} contacts
	{{ link_to('contacts/create', 'Add a contact', 'class': 'btn btn-sm btn-info') }}
</h1>

{% if contacts.count() > 0 %}
<div class="card-group">
	{% for contact in contacts %}
	{% if loop.index0 % 4 == 0 %}</div><br><div class="card-group">{% endif %}
	<div class="card">
		<img class="card-img-top" src="https://picsum.photos/id/{{ contact.id }}/400/180" alt="Contact image">
		<div class="card-body">
			<h5 class="card-title">{{ contact.first_name }} {{ contact.last_name }} <small class="text-muted float-right">#{{ contact.id }}</small></h5>
			<p class="card-text">(m) {{ contact.email }}</p>
			{{ link_to('contacts/update/' ~ contact.id, 'edit', 'class': 'btn btn-sm btn-primary') }}
			{{ link_to('contacts/delete/' ~ contact.id, 'delete', 'class': 'btn btn-sm btn-link') }}
		</div>
		<div class="card-footer">
			<small class="text-muted">Created {{ contact.created_at }}</small>
		</div>
	</div>
	{% if loop.last and loop.length % 4 > 0 %}
		{% set remainder = 4 - (loop.length % 4) %}
		{% for i in (1 .. remainder) %}<div class="card"></div>{% endfor %}
	{% endif %}
	{% endfor %}
</div>
<br>
{% endif %}

