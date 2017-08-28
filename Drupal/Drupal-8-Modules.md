# Drupal 8 Modules

Create `/web/modules/<module>/<modules.info.yml` and add some base info.

```
name: Hello World
description: A silly example module

type: module
core: 8.x

# if there are requirements
dependencies:
  - node
  - rest
  - system (>=8.2.0)
```

## Hooks

`HOOK_entity_load()`

Generally you can place hooks into one of three categories:

1. Hooks that answer a question
2. Hooks that alter existing data
3. Hooks that react to an action
