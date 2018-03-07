# Lab 2 Solutions

## Inventory

Your inventory file should look like this:

```
[databases]
db-green.shoup.fun

[webservers]
www-green.shoup.fun
```

## Setup

Your setup command should look like this:

```bash
ansible -i inventory -m setup -k -u student all
```

## Copy

Your copy command should look like this:

```bash
echo 'ansible is awesome' > /tmp/foobar
ansible -i inventory -m copy -a 'src=/tmp/foobar dest=/opt/foobar' -k -b -u student www-green.shoup.fun
```
