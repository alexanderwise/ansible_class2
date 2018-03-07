# Intro to Ansible

## Control nodes

The control node is a workstation that you execute and run Ansible playbooks
from. It can be running:

* Linux
* Mac OS X
* Windows 10 w/ Bash on Ubuntu on Windows
* Other Unix like operating systems (FreeBSD, Solaris, etc)

You just need Python 2.6 or later installed

See: http://docs.ansible.com/ansible/latest/intro_installation.html

## Managed node requirements

Ansible can manage nodes running:

* Linux (via SSH)
* Windows (via WinRM)
* BSD (via SSH)
* Probably others

Ansible uses no agent on the node systems.

# Lab

Let's go ahead and install Ansible on your workstation!

If you're not running one of the supported operating systems for control nodes,
it will be easiest to run Linux in something like VirtualBox.

This class is written for Ansible 2.4. Some things may not work in versions
older than 2.4.

Follow [the instructions here](http://docs.ansible.com/ansible/latest/intro_installation.html)
for your control node.

When done, run `ansible --version` and make sure you're running > 2.4.

```bash
$ ansible --version
ansible 2.4.3.0
  config file = /etc/ansible/ansible.cfg
  configured module search path = [u'/home/mike/.ansible/plugins/modules', u'/usr/share/ansible/plugins/modules']
  ansible python module location = /usr/lib/python2.7/dist-packages/ansible
  executable location = /usr/bin/ansible
  python version = 2.7.14 (default, Sep 23 2017, 22:06:14) [GCC 7.2.0]
```

[Move on to Ad-Hoc commands](02_ad-hoc_commands.md)
