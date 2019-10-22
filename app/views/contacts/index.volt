<h1>Contact List</h1>

{{ link_to('contacts/create', 'Add a contact', 'class': 'btn btn-primary') }}

{% if contacts.count() > 0 %}
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="4">total contacts: {{ contacts.count() }}</td>
        </tr>
        </tfoot>
        <tbody>
        {% for contact in contacts %}
            <tr>
                <td>{{ contact.id }}</td>
                <td>{{ contact.first_name }} {{ contact.last_name }}</td>
                <td>{{ contact.email }}</td>
                <td>{{ link_to('contacts/delete/' ~ contact.id, 'delete') }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endif %}

