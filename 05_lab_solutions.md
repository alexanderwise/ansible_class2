`roles/webapp/tasks/main.yml`:

```yaml
---
# tasks file for webapp
- name: Install httpd
  yum:
    name: httpd
    state: present
- name: Start and enable httpd
  service:
    name: httpd
    state: started
    enabled: yes
- name: Install PHP packages
  yum:
    name: "{{ item }}"
    state: present
  with_items:
    - php
    - php-mysql
  notify: Restart httpd
- name: copy index.php
  copy:
    src: files/index.php
    dest: /var/www/html/
```

`roles/webapp/handlers/main.yml`:

```yaml
---
# handlers file for webapp
- name: Restart httpd
  service:
    name: httpd
    state: restarted
```

`webservers.yml`:

```yaml
---
- name: Webservers
  hosts: webservers
  roles:
    - webapp
```

---

[Back to the lesson](05_your_first_role.md)
