Your `authorized_keys.yml` file might look like this:

```yaml

- name: Authorize me
  hosts: all
  vars:
    my_key: ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCiBRqjCEnUWYw9X804RKFVhO0W/gFlVheVJILFQ00tDsSN7YxmCz7M3JIApV0B4qccf+QngrpTo2l8nS+p4uCvYWICBq0Ppg3gAIXXi6x5Q7NETVa5rMddVJuNX1H+qxujLifdwpkTkjD2aHkkzVfrWF3wbSxeR1Wf4F8gh0k9MdZoqwR9w1JIKKh0src8EQI5NGFxYU2YS4ZjcP4w3EeLKMyDYgBjCJL1WbXNSfUKH31w4l0XsDOhzpT0mPpikk2nEm+Vg8tN1I+oZdbPqUgPDeg0q8iJ4fKVVbFgVFwJ6wc2i0olJN9XsFjVABNXclB6OL+SFt7yPOCMyjqRZDFJ mike@lappy.home.shoup.io
  tasks:
    - name: Authorize my SSH key
      authorized_key:
        key: "{{ my_key }}"
        user: student
        state: present
```

Executing the playbook:

```bash
$ ansible-playbook -i inventory -k -u student authorized_keys.yml
SSH password:

PLAY [all] ********************************************************************

TASK [Gathering Facts] ********************************************************
ok: [www-apple.house-of-py.com]
ok: [db-apple.house-of-py.com]

TASK [Authorize my SSH key] ***************************************************
changed: [www-apple.house-of-py.com]
changed: [db-apple.house-of-py.com]

PLAY RECAP ********************************************************************
db-apple.house-of-py.com         : ok=2    changed=1    unreachable=0    failed=0   
www-apple.house-of-py.com        : ok=2    changed=1    unreachable=0    failed=0   
```

## Fun fact!

The `authorized_key` module actually allows you to specify a URL to download
the public keys from. Combine this with the handy URLs that online git repo
hosts provide for getting a user's keys, you can use them for your SSH key
database!

i.e., you might have this in your playbook:

```
key: https://gitlab.com/shouptech.keys
```

---

[Back to the lesson](03_your_first_playbook.md)
