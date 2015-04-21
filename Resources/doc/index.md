Documentation
==============

Simple example
--------------

SSH connections can be configured in bundle configuration.

```
janis_gruzis_ssh:
    connections:
        prod:
            type: password
            host: foo.com
            username: foo
            password: bar
        public:
        	type: none
        	host: foo.com
        	username: foo
```

Connection types
----------------

There can be multiple connections with different types. The types are:

```
janis_gruzis_ssh:
    connections:
        none:
        	type: none
        	host: foo.com
        	username: foo
        password:
            type: password
            host: foo.com
            username: foo
            password: bar
        config:
        	type: config
        	config: ~/.ssh/config
        	host_name: bar_foo_com
        	username: foo # Optional
        	password: bar # Optional
        agent:
        	type: agent
        	host: foo.com
        	username: foo
        public_key:
        	type: public_key
        	host: foo.com
        	username: foo
        	pass_phrase: bar # Optional
        	public_key_file: ./.ssh/id_dsa.pub
        	private_key_file: ./.ssh/id_dsa
```

Services
--------

Each connection session can be accessed as service. For example configuration the services would be:

```
ssh.session.prod
ssh.session.public
```

The service will return instance of class `Ssh\Session` from `herzult/php-ssh`.