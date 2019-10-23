{{ form('contacts/update/' ~ contact.id, 'method': 'post') }}

<div class="form-group">
	<label for='first_name'>First Name</label>
	{{ form.render('first_name', ['size': 32, 'class': 'form-control']) }}
</div>

<div class="form-group">
	<label for='last_name'>Last Name</label>
	{{ form.render('last_name', ['size': 32, 'class': 'form-control']) }}
</div>

<div class="form-group">
	<label for='email'>Email Address</label>
	{{ form.render('email', ['size': 32, 'class': 'form-control']) }}
</div>

{{ submit_button('Update', 'class': 'btn btn-primary') }}

{{ end_form() }}

