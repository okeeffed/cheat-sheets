# Chef General

<!-- TOC -->

*   [Chef General](#chef-general)
    *   [kitchen commands](#kitchen-commands)
    *   [Chef ops layout](#chef-ops-layout)

<!-- /TOC -->

## kitchen commands

| Commands              | Action                             |
| --------------------- | ---------------------------------- |
| kitchen test          | Tear down & restart full build     |
| kitchen converge <id> | Re-run recipes on already built VM |
| kitchen list          | List all the VM IDs                |
| kitchen verify <id>   | Verify kitchen tests               |
| kitchen login <id>    | Login to a local VM                |
| kitchen destroy <id>  | Tear down instance                 |

## Chef ops layout

Without the hidden files.

```
.
├── Berksfile
├── Berksfile.lock
├── README.md
├── cookbooks
│   ├── example
│   │   ├── files
│   │   │   └── default
│   │   │       ├── known_hosts		# accessible with cookbook_file
│   │   │       └── ssh_config
│   │   ├── metadata.rb
│   │   ├── recipes
│   │   │   ├── configure.rb
│   │   │   └── default.rb
│   │   └── templates
│   │       ├── newrelic-node.erb
│   │       ├── nginx-node.erb
│   │       └── ssh-key.erb
│   ├── example-api
│   │   ├── metadata.rb
│   │   ├── recipes
│   │   │   ├── configure.rb
│   │   │   ├── default.rb
│   │   │   └── deploy.rb
│   │   └── templates
│   │       └── env.erb
│   ├── example-bot
│   │   ├── metadata.rb
│   │   ├── recipes
│   │   │   ├── configure.rb
│   │   │   ├── default.rb
│   │   │   └── deploy.rb
│   │   └── templates
│   │       └── env.erb
│   └── example-db
│       ├── metadata.rb
│       ├── recipes
│       │   ├── configure.rb
│       │   ├── default.rb
│       │   └── deploy.rb
│       └── templates
│           └── env.erb
├── publish.sh
└── test
    ├── data_bags
    │   ├── data_app
    │   │   ├── data_api.json
    │   │   ├── data_bot.json
    │   │   └── data_db.json
    │   └── data_command
    │       ├── deploy_data_api.json
    │       ├── deploy_data_bot.json
    │       └── deploy_data_db.json
    ├── environments
    │   ├── test.json
    │   └── test.json.example
    └── smoke
        ├── test
        │   └── default_test.rb
        ├── second
        │   └── default_test.rb
        └── third
            └── default_test.rb
```
