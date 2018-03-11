# Ansible Roles

Roles are a way to group variables, tasks, and handlers into reusable units of
work.

In our project structure, we already have a typical layout for a role. See
[Ansible's documentation](http://docs.ansible.com/ansible/latest/playbooks_reuse_roles.html#role-directory-structure)
for other folders you might want in your role.

## Creating a role

Remember our task to download Pride and Prejudice? You could make this into a
reusable role.

First, we can create a file defining our variable, `book_url`. We will put this
in the `defaults` folder, allowing consumers of our role to easily override this
variable if needed.

`roles/pride_and_prejudice/defaults/main.yml`:

```yaml
book_url: http://www.gutenberg.org/files/1342/1342-0.txt
```

Next, we have to define the task.

`roles/pride_and_prejudice/tasks/main.yml`:

```yaml
---
- name: Download pride and prejudice # Optional name of task to be executed
  fetch_url: # Name of Ansible module to execute
    url: "{{ book_url }}" # Ansible uses Jinja2 templating when running playbooks
    dest: /opt/pride.txt
```

Finally, in our playbook we remove the `vars` and `tasks` sections, and simply
reference the role:

```yaml
---
- name: Sample playbook # Optional name for your playbook
  hosts: server01 # This is either a group or specific host to execute tasks on
  roles: # Roles executed in this play
    - pride_and_prejudice # The name of our role
```

## Lab

In the project folder, I've already created part of a role for you called
`webapp`. This role currently has no tasks. You need to update the role to do
the following:

1. Use the `yum` module to install the `httpd` package
2. Use the `service` module to start the httpd service and enable it at startup
3. Use the `yum` module to install the `php` & `php-mysql` packages. You will
   also need to create a handler that restarts the `httpd` service.
4. Use the `copy` module to copy `files/index.php` to the remote server's
   `/var/www/html` directory.

Once finished, you should be able to open your browser, and point it to
`http://www-<server>.shoup.fun/` and see the webapp load. There *will* be an
error because we haven't configured a database. We'll get there.
