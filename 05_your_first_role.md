# Ansible Roles

Roles are a way to group variables, tasks, and handlers into reusable units of
work.

In our project structure, we already have a typical layout for a role. See
[Ansible's documentation](http://docs.ansible.com/ansible/latest/playbooks_reuse_roles.html#role-directory-structure)
for other folders you might want in your role.

## Creating a role

Remember our task to download Pride and Prejudice? You could make this into a
reusable role.

First, we can create a file deifning our variable, `book_url`. We will put this
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
