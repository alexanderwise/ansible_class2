# Adding some logic

Being able to SSH into multiple servers and execute commands is nice, but automation
needs some ability to intelligent respond to errors and rollback if needed.

Fortunately, Ansible gives us a several different types of logical operators:

From the documents page [https://docs.ansible.com/ansible/latest/user_guide/playbooks_blocks.html]:

```yaml
tasks:
  - name: Install, configure, and start Apache
    block:
    - name: install httpd and memcached
      yum:
        name: "{{ item }}"
        state: present
      loop:
        - httpd
        - memcached
        - openssl
    - name: apply the foo config template
      template:
        src: templates/src.j2
        dest: /etc/foo.conf
    - name: create Diffie-Hellman parameters file
      command: sudo openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
      args:
        creates: /etc/ssl/certs/dhparam.pem
      notify: example_handler
    - name: start service httpd and enable it
      service:
        name: httpd
        state: started
        enabled: True
    rescue:
      - debug:
          msg: 'I caught an error'
      - name: i force a failure in middle of recovery! >:-)
        command: /bin/false
      - debug:
          msg: 'I also never execute :-('
    always:
      - debug:
          msg: "This always executes"    
    when: ansible_facts['distribution'] == 'CentOS'
    become: true
    become_user: root
    ignore_errors: yes
handlers:
  - name: example_handler
    debug:
      msg: "I was notified by the 'remove default config' task"
```

Whoa, that's a lot of new content. Way too much of an info dump for a SFS class.
Discussing how each of these work would be way too much for an introduction,
but I think it's important to know that Ansible is capable of fairly advanced
behavior.

Let's walk through some of these operators:

`block:` lets you logically group tasks together. Great for organization and
   handling errors when things need to succeed or fail together. Used with `rescue`
   and `always blocks`

`rescue:` a series of tasks to perform if a block encounters an error. Great for
   graceful recovery or cleanup

`always:` a group of tasks that always runs, whether the block encounters an error
   or not. great for restarting services or notifying handlers.



`notify:` & `handlers:` handlers are a type of task than can be called by other
   tasks who "notify" them. Good for doing a thing only if another thing is done.
   For example, only clear a varnish cache if website content has changed.



`when:` will evaluate a boolean statement to determine if a task should be performed
   Great for performing tasks based on environment (like OS)



`creates:` & `removes:` an argument for the `command` module (BOO) that tests if
a file exists or not, and uses that logic to decide whether to perform the task.
