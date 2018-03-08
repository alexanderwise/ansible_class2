# Structuring Your Project

## The Tree

It's a good idea to think ahead about how to structure a project. Here's a
sample layout, one we will use for this class:

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
├── databases.yml
├── inventory
├── requirements.yml
├── site.yml
└── .vault_pass
```
