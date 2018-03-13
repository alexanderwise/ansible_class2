# Ansible Galaxy

[Ansible Galaxy](https://galaxy.ansible.com/) is essentially an online hub of
Ansible roles. Community members can create their own role and share them with
the rest of the community.

To use roles from Ansible Galaxy, you need to use the `ansible-galaxy` command.

For example, to install a role you can do:

```bash
ansible-galaxy install shouptech.nextcloud
```

or, you can define all the roles needed in a text file:

`galaxy-requirements.yml`:

```yaml
# You can specify the name of the project from Ansible Galaxy
- src: shouptech.nextcloud
- src: elastic.elasticsearch
# Or, you can even specify a git repo
- src: git@github.com:networklore/ansible-role-nagios.git
```

```bash
ansible-galaxy install -r galaxy-requirements.yml
```

In your playbook, you'll then reference the name of the Galaxy:

```yaml
- name: Install nextcloud
  hosts: nextcloud-servers
  roles:
    - shouptech.nextcloud
```
