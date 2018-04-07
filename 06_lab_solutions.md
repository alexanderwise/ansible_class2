`galaxy-requirements.yml`:

```yaml
- src: bertvv.mariadb
```

`roles/group_vars/databases/mariadb.yml`:

```yaml
mariadb_bind_address: 0.0.0.0
mariadb_databases:
  - name: webapp
mariadb_root_password: 'somethingsecure'
mariadb_users:
  - name: webapp
    password: 'securepassword'
    host: '%'
    priv: 'webapp.*:ALL'
```

`webapp.yml`:

```yaml
- name: webservers
  hosts: webservers
  roles:
    - webapp

- name: databases
  hosts: databases
  roles:
    - bertvv.mariadb
```

```bash
$ ansible-galaxy install -r galaxy-requirements.yml
- downloading role 'mariadb', owned by bertvv
- downloading role from https://github.com/bertvv/ansible-role-mariadb/archive/v2.0.2.tar.gz
- extracting bertvv.mariadb to /home/mshoup/.ansible/roles/bertvv.mariadb
- bertvv.mariadb (v2.0.2) was installed successfully
$ ansible-playbook -i inventory webapp.yml
[...]

db-clementine.shoup.fun    : ok=18   changed=3    unreachable=0    failed=0   
www-clementine.shoup.fun   : ok=5    changed=0    unreachable=0    failed=0   
```
---

`group_vars/webservers/config.yml`:

```yaml
webapp_dbname: webapp
webapp_dbuser: webapp
webapp_dbpass: securepassword
webapp_dbhost: db-clementine.shoup.fun
```

`roles/webapp/tasks/main.yml`:

```yaml
[...]

- name: copy config file
  template:
    src: templates/config.php.j2
    dest: /var/www/html/config.php
```

```bash
$ ansible-galaxy install -r galaxy-requirements.yml
```

[Back to the lesson](06_ansible_galaxy.md)
