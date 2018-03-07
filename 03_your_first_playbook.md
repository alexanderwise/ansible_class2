# Your first playbook

We can define all the tasks to be executed against our environment using yaml.
These definitions are called playbooks.

Remember the ad-hoc command to download Pride and Prejudice to the webserver?
We can easily define this behavior in a playbook, so that it can be executed
repeatedly:

```yaml
---
- name: Sample playbook # Optional name for your playbook
  hosts: server01 # This is either a group or specific host to execute tasks on
  vars: # This is variables that will be definited for this specific 'play'
    book_url: http://www.gutenberg.org/files/1342/1342-0.txt
  tasks:
    - name: Download pride and prejudice # Optional name of task to be executed
      fetch_url: # Name of Ansible module to execute
        url: "{{ book_url }}" # Ansible uses Jinja2 templating when running playbooks
        dest: /opt/pride.txt
```

You would execute a playbook with the `ansible-playbook` command. An example
might look like this:

```bash
ansible-playbook -i inventory -u remote_user -k playbook.yml
```

# Lab

## SSH Keys

Write a small playbook named `authorized_keys.yml` that copies adds your public
SSH key to the student user's authorized_keys file on `all` of the servers in
your inventory.

Note: The
[authorized_key](http://docs.ansible.com/ansible/latest/authorized_key_module.html)
module will be very helpful for this.

Execute the playbook and try to SSH into the servers as the user student with
only your SSH key.

## Solution

[See here for solutions](03_lab_solutions.md)
