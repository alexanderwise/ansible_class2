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

## Lab

Let's install the awesome
[`bertvv.mariadb` role](https://galaxy.ansible.com/bertvv/mariadb/) on our
database servers.

1. Create a `galaxy-requirements.yml` file containing the role and use the
  `ansible-galaxy` command to isntall the role.
2. Using the [documentation for the role](https://galaxy.ansible.com/bertvv/mariadb/),
  configure the following. Define the variables in a file
  `group_vars/databases/mariadb.yml`.
  * Set the bind address to `0.0.0.0`
  * Configure a database named `webapp`
  * Set the root password to something secure. (Forget the fact it's plaintext.
    We'll fix that in the next lab.)
  * Add a user named `webapp`, host `%` and  with the privileges `webapp.*:ALL`.
    Set a secure password, and like the root password, we'll encrypt it in the
    next lab.
3. Update `webapp.yml` to install the `bertvv.mariadb` role on any server in
  the `databases` group.
4. Now's a good time to run the `webapp.yml` playbook to make sure the role is
  installing correctly.
5. Use the
  [template module](http://docs.ansible.com/ansible/latest/modules/template_module.html)
  to copy the `templates/config.php.j2` file to `/var/www/html/config.php` as
  part of the `webapp` role. You will need to define the variables for the
  `webservers` group.
6. Run the `webapp.yml` playbook. Point your browser to your webserver and see
  if everything works.

## Solutions

[See here for solutions](06_lab_solutions.md)
