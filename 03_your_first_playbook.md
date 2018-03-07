# Your first playbook

We can define all the tasks to be executed against our environment using yaml.
These definitions are called playbooks.

Remember the ad-hoc command to download Pride and Prejudice to the webserver?
We can easily define this behavior in a playbook, so that it can be executed
repeatedly:

```yaml
---
- hosts: server01 # This is either a group or specific host to execute tasks on
  vars: # This is variables that will be definited for this specific 'play'
    book_url: http://www.gutenberg.org/files/1342/1342-0.txt
  tasks:
    - name: Download pride and prejudice # Optional name of task to be executed
      fetch_url: # Name of Ansible module to execute
        url: "{{ book_url }}" # Ansible uses Jinja2 templating when running playbooks
        dest: /opt/pride.txt
```
