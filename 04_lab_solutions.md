`ansible.cfg`

```
[defaults]
remote_user = student

[privilege_escalation]
become=True
```

Execute:

```bash
ansible-playbook -i inventory authorized_keys.yml
```

---

[Back to the lesson](04_structuring_your_project.md)
