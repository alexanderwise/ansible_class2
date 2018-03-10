# Structuring Your Project

## The Tree

It's a good idea to think ahead about how to structure a project. Here's a
sample layout, and how I typically layout a project:

```
├── group_vars
│   └── webservers
│       └── vars.yml # Default variables for servers in the group 'webservers'
├── host_vars
│   └── db-green.shoup.fun
│       └── databases.yml # Variables for a specific host
├── roles
│   └── webapp # A role to install webapp
|       |      # All the folders, except probably 'tasks' are optional
│       ├── defaults
│       │   └── main.yml # Default variables for this role (lowest precedence)
│       ├── handlers
│       │   └── main.yml # Defined handlers for this role
│       ├── tasks
│       │   └── main.yml # Tasks for this role
│       ├── vars
│       │   └── main.yml # More variables for this role (higher precedence)
│       └── README.md # Documentation
├── ansible.cfg # Configurations specific for this project
├── authorized_keys.yml # Your authorized_keys playbook
├── databases.yml # A playbook for databases
├── inventory # Your inventory file
├── requirements.yml # Role requirements for Ansible Galaxy
├── site.yml # A playbook for your entire site
└── .vault_pass # A file containing your vault password, should *not* be committed
```

## Lab

If you haven't already, clone the class repo, and do the following:

Copy your inventory and authorized_keys.yml file into the project folder

Set some defaults in ansible.cfg:
  * Set the default remote user to `student`
  * Make `become` default to `True`.

Execute the authorized_keys playbook, this time, specifying only the inventory
file and playbook. You should not need to instruct the `ansible-playbook`
command to ask for a password, or to specify the remote user.

---

[Move on to Your First Role](05_your_first_role.md)
