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
│   └── wordpress # A role to install wordpress
|       |         # All the folders, except probably 'tasks' are optional
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
