# Vim

<!-- TOC -->

- [Vim](#vim)
    - [Vim Packages and creating files](#vim-packages-and-creating-files)
    - [Vim modes, navigation and commands](#vim-modes--navigation-and-commands)
    - [Executing external commands](#executing-external-commands)
    - [Files and buffers](#files-and-buffers)

<!-- /TOC -->

## Vim Packages and creating files

Installing Vim `yum install vim` of `apt-get install vim`.

`vim -g` can actually run the GUI - who cares though. There are a number of different GUI wrappers. `gvim` is the most popular.

So we have `vi`, `vim` - the improved vi and `gvim`.

## Vim modes, navigation and commands

1.  Command/Normal mode
2.  Insert/Ex mode
3.  Mark mode

| Key                    | What it does                      |
| ---------------------- | --------------------------------- |
| x                      | Delete character                  |
| :q!                    | Quit and omit changes             |
| :wq                    | Write and quit                    |
| :                      | "File mode"                       |
| h                      | Left                              |
| j                      | Down                              |
| k                      | Up                                |
| l                      | Right                             |
| w                      | Word forward                      |
| e                      | Word forward last char            |
| b                      | Back word                         |
| 0                      | Go to start                       |
| $                      | Go to end                         |
| v                      | Highlight words                   |
| %                      | Go to matching bracket/quotes etc |
| Number, command        | Move by certain amount            |
| r                      | Replace                           |
| u                      | Undo                              |
| .                      | Redo                              |
| d (twice)              | Delete the line                   |
| d, w                   | Delete the word                   |
| Number, i              | Insert a number of times          |
| Number, r              | Replace a number of chars         |
| Number, x              | Delete certain number of keys     |
| y, move to new spot, p | Yank the link, then paste         |
| v, then y              | Mark mode and yank                |
| >>                     | Indent forward                    |
| <<                     | Indent back                       |
| /<word>                | Find a word                       |
| n/N                    | Forward search, N upwards         |
| ?<word>                | Search bottom up (N/n swap)       |
| %s/ex/EX/g             | Global ex regex                   |
| #s/ex/EX/gc            | Confirm value swapping            |

## Executing external commands

These are a few of the more advanced things.

`: ! ls -al ~` - it will run the command, and then we get the option to run a command.

`:r ! cat /root/.bash_profile` for example will read in the profile.

## Files and buffers

`:saveas <name|path>`
