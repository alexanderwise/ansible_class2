# Ad-Hoc Commands

Let's get ourselves setup for Ansible and play with some ad-hoc commands!

## Inventory

First things first, Ansible needs an
[inventory file](http://docs.ansible.com/ansible/latest/intro_inventory.html).
The inventory file defines which hosts are managed by Ansible. The inventory
file can also be used to define variables, but there are other ways to do that.

A simple inventory file could look like:

```
[databases]
# You can define them individually in a group
db01.example.com
db02.example.com

[webservers]
# You can even define a large group of servers
www[01:25].example.com

[monitor-agents:children]
# Groups can be members of other groups
webservers
databases

[hardened]
# Servers can be defined in multiple groups
db01.example.com
```

The ansible package provides an example inventory file at `/etc/ansible/hosts`.
I usually don't use that and keep a copy of my inventory in the repository for
my Ansible stuff.

There are also two special groups:

* `all` - This group contains all servers in your inventory
* `ungrouped` - This group contains servers that aren't in any group except `all`.

## The `ansible` command

Before you even start defining tasks and roles in code, you can actually just
act on your inventory with simple commands. For example, maybe you just want
to ping a group of servers:

```bash
ansible -i inventory -m ping all
#  |         |           |    |
#  |         |           |    +- all hosts
#  |         |           +- execute the `ping` module
#  |         +- path to your inventory file
#  +- ansible command
```

Download pride and prejudice to a group of servers using the
[get_url](http://docs.ansible.com/ansible/latest/get_url_module.html) module:

```bash
#                     +- Ask for SSH password
#                     |     +- get_url module
#                     |     |             +- Arguments for the get_url module                  server to act on -+
#                     |     |             |                                                                      |
ansible -i inventory -k -m get_url -a 'url=http://www.gutenberg.org/files/1342/1342-0.txt dest=/opt/pride.txt' server01
server01 | SUCCESS => {
    "changed": true,
    "checksum_dest": null,
    "checksum_src": "ee19094b7f64279891b6051339e17d5ae6b6e92a",
    "dest": "/tmp/pride.txt",
    "gid": 0,
    "group": "root",
    "md5sum": "5f2319239819dfa7ff89ef847b08aff0",
    "mode": "0644",
    "msg": "OK (726223 bytes)",
    "owner": "root",
    "size": 726223,
    "src": "/tmp/tmpjxTgsn",
    "state": "file",
    "status_code": 200,
    "uid": 0,
    "url": "http://www.gutenberg.org/files/1342/1342-0.txt"
}
```

# Lab

## Inventory

Create an inventory file containing the two servers I've provisioned for you.

The `db` server should be in a group called `databases` and the `www` server
should be in a group called `webservers`.

## Setup

Using the `ansible` command, execute the `setup` module against `all` hosts in
your inventory.

Notes:
* You will need to provide the `student` username on the command line:
`-u student`
* You will also need to instruct ansible to ask for your SSH password (`-k`).

## Copy

Create a text file on your computer containing whatever you want, and copy it
to `/opt` on your webserver using the `ansible` command.

Notes:
* You will need to instruct ansible to run commands with sudo (`-b`)
* See the [copy module](http://docs.ansible.com/ansible/latest/copy_module.html)

## Solutions

[See here for solutions](02_lab_solutions.md)

---

[Move on to Your First Playbook](03_your_first_playbook.md)
