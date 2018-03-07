# Lab 2 Solutions

## Inventory

Your inventory file should look like this:

```
[databases]
db-green.shoup.fun

[webservers]
www-green.shoup.fun
```

## Ping

Your ping command should look like this:

```bash
ansible -i inventory -m ping -k -u student all
```

## Copy

Your copy command should look like this:

```bash
ansible -i inventory -m copy -a 'src=/tmp/foobar dest=/opt/foobar' -k -u student www-green.shoup.fun
```
