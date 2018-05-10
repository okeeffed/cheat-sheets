# SSH Overview

<!-- TOC -->

*   [SSH Overview](#ssh-overview)
    *   [SSH-1: How SSH Works](#ssh-1-how-ssh-works)
    *   [SSH-2: How SSH Authenticates Users](#ssh-2-how-ssh-authenticates-users)
    *   [SSH-3: Generating and Working with SSH Keys](#ssh-3-generating-and-working-with-ssh-keys)
        *   [SSH-4: Generate an SSH Key Pair with a Larger Number of Bits](#ssh-4-generate-an-ssh-key-pair-with-a-larger-number-of-bits)
        *   [SSH-5: Displaying the SSH Key Fingerprint](#ssh-5-displaying-the-ssh-key-fingerprint)
        *   [SSH-6: Copying your Public SSH Key to a Server with SSH-Copy-ID](#ssh-6-copying-your-public-ssh-key-to-a-server-with-ssh-copy-id)
        *   [SSH-7: Copying your Public SSH Key to a Server Without SSH-Copy-ID](#ssh-7-copying-your-public-ssh-key-to-a-server-without-ssh-copy-id)
        *   [SSH-8: Manually copy your Public SSH Key to a Server](#ssh-8-manually-copy-your-public-ssh-key-to-a-server)
    *   [SSH-9: Basic Connection Instructions](#ssh-9-basic-connection-instructions)
        *   [SSH-10: Running a Single Command on a Remote Server](#ssh-10-running-a-single-command-on-a-remote-server)
        *   [SSH-11: Logging into a Server with a Different Port](#ssh-11-logging-into-a-server-with-a-different-port)
        *   [SSH-12: Adding your SSH Keys to an SSH Agent to Avoid Typing the Passphrase](#ssh-12-adding-your-ssh-keys-to-an-ssh-agent-to-avoid-typing-the-passphrase)
    *   [SSH-13: Forwarding your SSH Credentials to Use on a Server](#ssh-13-forwarding-your-ssh-credentials-to-use-on-a-server)
    *   [SSH-14: Server-Side Configuration Options](#ssh-14-server-side-configuration-options)
        *   [SSH-15: Disabling Password Authentication](#ssh-15-disabling-password-authentication)
        *   [SSH-16: Changing the Port that the SSH Daemon Runs On](#ssh-16-changing-the-port-that-the-ssh-daemon-runs-on)
    *   [SSH-17: Limiting the Users who can connect through SSH](#ssh-17-limiting-the-users-who-can-connect-through-ssh)
    *   [SSH-18: Disabling Root Login](#ssh-18-disabling-root-login)
    *   [SSH-19: Allowing Root Access for Specific Commands](#ssh-19-allowing-root-access-for-specific-commands)
    *   [SSH-20: Forwarding X Application Displays to the Client](#ssh-20-forwarding-x-application-displays-to-the-client)
    *   [SSH-21: Client Side Configuration Options](#ssh-21-client-side-configuration-options)
        *   [SSH-22: Keep Connections Alive to Avoid Timeout](#ssh-22-keep-connections-alive-to-avoid-timeout)
    *   [SSH-23: Disabling Host Checking](#ssh-23-disabling-host-checking)
        *   [SSH-24: Multiplexing SSH Over a Single TCP Connection](#ssh-24-multiplexing-ssh-over-a-single-tcp-connection)
    *   [SSH-25: Setting Up SSH Tunnels](#ssh-25-setting-up-ssh-tunnels)
    *   [UBU-1: Installing Ubuntu onto VirtualBox](#ubu-1-installing-ubuntu-onto-virtualbox)

<!-- /TOC -->

**Sources**

Justin Ellingwood form [Digital Ocean](https://www.digitalocean.com/community/tutorials/ssh-essentials-working-with-ssh-servers-clients-and-keys)

[Daemon (computing)](<https://en.wikipedia.org/wiki/Daemon_(computing)>)

[Grymoire](http://www.grymoire.com/Unix/) - Great resource for UNIX!

Setting up [Ubuntu on Virtual Box](http://www.simplehelp.net/2015/06/09/how-to-install-ubuntu-on-your-mac/)

---

**Major Section Index**

*   <a href="#SSH-1"><p>SSH-1: How SSH Works</p></a>

**Pre-requisites**

*   <a href="#UBU-1"><p>UBU-1: Installing Ubuntu Onto Virtual Box</p></a>

---

**Abstract**

SSH is a secure protocol used as the primary means of connecting to Linux servers remotely. It provides a text-based interface by spawning a remote shell. After connecting, all commands you type in your local terminal are sent to the remote server and executed there.

The most common way of connecting to a remote Linux server is through SSH. SSH stands for Secure Shell and provides a safe and secure way of executing commands, making changes, and configuring services remotely. When you connect through SSH, you log in using an account that exists on the remote server.

---

<div id="SSH-1"></div>
## SSH-1: How SSH Works

When you connect through SSH, you will be dropped into a shell session, which is a text-based interface where you can interact with your server. For the duration of your SSH session, any commands that you type into your local terminal are sent through an encrypted SSH tunnel and executed on your server.

The SSH connection is implemented using a client-server model. This means that for an SSH connection to be established, the remote machine must be running a piece of software called an SSH daemon. This software listens for connections on a specific network port, authenticates connection requests, and spawns the appropriate environment if the user provides the correct credentials.

The user's computer must have an SSH client. This is a piece of software that knows how to communicate using the SSH protocol and can be given information about the remote host to connect to, the username to use, and the credentials that should be passed to authenticate. The client can also specify certain details about the connection type they would like to establish.

Refer to the "Managing Ubuntu Help Sheet" MU-1 for more information about setting up the SSH Client and SSH Server.

---

## SSH-2: How SSH Authenticates Users

Clients generally authenticate either using passwords (less secure and not recommended) or SSH keys, which are very secure.

We recommend always setting up SSH-based authentication for most configurations.

---

**Definition: _SSH keys_**

SSH keys are a matching set of cryptographic keys which can be used for authentication. Each set contains a public and a private key. The public key can be shared freely without concern, while the private key must be vigilantly guarded and never exposed to anyone.

---

To authenticate using SSH keys, a user must have an SSH key pair on their local computer. On the remote server, the public key must be copied to a file within the user's home directory at `~/.ssh/authorized_keys`. This file contains a list of public keys, one-per-line, that are authorized to log into this account.

When a client connects to the host, wishing to use SSH key authentication, it will inform the server of this intent and will tell the server which public key to use. The server then check its `authorized_keys` file for the public key, generate a random string and encrypts it using the public key. This encrypted message can only be decrypted with the associated private key. The server will send this encrypted message to the client to test whether they actually have the associated private key.

Upon receipt of this message, the client will decrypt it using the private key and combine the random string that is revealed with a previously negotiated session ID. It then generates an MD5 hash of this value and transmits it back to the server. The server already had the original message and the session ID, so it can compare an MD5 hash generated by those values and determine that the client must have the private key.

---

## SSH-3: Generating and Working with SSH Keys

**Generating a SSH Key Pair**

Generating a new SSH public and private key pair on your local computer is the first step towards authenticating with a remote server without a password. Unless there is a good reason not to, you should always authenticate using SSH keys.

A number cryptographic algorithms can be used to generate SSH keys, including RSA, DSA, and ECDSA. RSA keys are generally preferred and are the default key type.

To generate an RSA key pair on your local computer, type:

```
ssh-keygen
```

```
Generating public/private rsa key pair.
Enter file in which to save the key (/home/demo/.ssh/id_rsa):
```

This prompt allows you to choose the location to store your RSA private key. Press ENTER to leave this as the default, which will store them in the .ssh hidden directory in your user's home directory. Leaving the default location selected will allow your SSH client to find the keys automatically.

```
Enter passphrase (empty for no passphrase):
Enter same passphrase again:
```

The next prompt allows you to enter a passphrase of an arbitrary length to secure your private key. By default, you will have to enter any passphrase you set here every time you use the private key, as an additional security measure. Feel free to press ENTER to leave this blank if you do not want a passphrase. Keep in mind though that this will allow anyone who gains control of your private key to login to your servers.

If you choose to enter a passphrase, nothing will be displayed as you type. This is a security precaution.

```
Your identification has been saved in /root/.ssh/id_rsa.
Your public key has been saved in /root/.ssh/id_rsa.pub.
The key fingerprint is:
8c:e9:7c:fa:bf:c4:e5:9c:c9:b8:60:1f:fe:1c:d3:8a root@here
The key's randomart image is:
+--[ RSA 2048]----+
|                 |
|                 |
|                 |
|       +         |
|      o S   .    |
|     o   . * +   |
|      o + = O .  |
|       + = = +   |
|      ....Eo+    |
+-----------------+
```

This procedure has generated an RSA SSH key pair, located in the .ssh hidden directory within your user's home directory. These files are:

*   ~/.ssh/id_rsa: The private key. **DO NOT SHARE THIS FILE!**
*   ~/.ssh/id_rsa.pub: The associated public key. This can be shared freely without consequence.

---

### SSH-4: Generate an SSH Key Pair with a Larger Number of Bits

SSH keys are 2048 bits by default. This is generally considered to be good enough for security, but you can specify a greater number of bits for a more hardened key.

To do this, include the -b argument with the number of bits you would like. Most servers support keys with a length of at least 4096 bits. Longer keys may not be accepted for DDOS protection purposes:

```
ssh-keygen -b 4096
```

If you had previously created a different key, you will be asked to overwrite your previous key.

```
Overwrite (y/n)?
```

_Show caution we you are looking to overwrite keys_

You may also be prompted to enter the old passphrase if you had one before generating a new one.

---

### SSH-5: Displaying the SSH Key Fingerprint

Each SSH key pair share a single cryptographic "fingerprint" which can be used to uniquely identify the keys. This can be useful in a variety of situations.

To find out the fingerprint of an SSH key, type:

```
ssh-keygen -l
```

```
Enter file in which the key is (/root/.ssh/id_rsa):
```

You can press ENTER if that is the correct location of the key, else enter the revised location. You will be given a string which contains the bit-length of the key, the fingerprint, and account and host it was created for, and the algorithm used:

```
4096 8e:c4:82:47:87:c2:26:4b:68:ff:96:1a:39:62:9e:4e  demo@test (RSA)
```

---

### SSH-6: Copying your Public SSH Key to a Server with SSH-Copy-ID

To copy your public key to a server, allowing you to authenticate without a password, a number of approaches can be taken.

If you currently have password-based SSH access configured to your server, and you have the `ssh-copy-id` utility installed, this is a simple process. The `ssh-copy-id` tool is included in many Linux distributions' OpenSSH packages, so it very likely may be installed by default.

If you have this option, you can easily transfer your public key by typing:

```
ssh-copy-id username@remote_host
```

This will prompt you for the remote password:

```
The authenticity of host '111.111.11.111 (111.111.11.111)' can't be established.
ECDSA key fingerprint is fd:fd:d4:f9:77:fe:73:84:e1:55:00:ad:d6:6d:22:fe.
Are you sure you want to continue connecting (yes/no)? yes
/usr/bin/ssh-copy-id: INFO: attempting to log in with the new key(s), to filter out any that are already installed
/usr/bin/ssh-copy-id: INFO: 1 key(s) remain to be installed -- if you are prompted now it is to install the new keys
demo@111.111.11.111's password:
```

After entering the password, your key will be copied, allowing you to log in without a password:

ssh username@remote_IP_host

---

### SSH-7: Copying your Public SSH Key to a Server Without SSH-Copy-ID

If you do not have the `ssh-copy-id` utility available, but still have password-based SSH access to the remote server, you can copy the contents of your public key in a different way.

You can output the contents of the key and pipe it into the `ssh` command. On the remote side, you can ensure that the `` ~/.ssh` directory exists, and then append the piped contents into the ``~/.ssh/authorized_keys` file:

```
cat ~/.ssh/id_rsa.pub | ssh username@remote_host "mkdir -p ~/.ssh && cat >> ~/.ssh/authorized_keys"
```

**Note:** You may also need to include the -i <yourkey.pem> flat in the ssh command to gain access for this.

---

### SSH-8: Manually copy your Public SSH Key to a Server

If you do not have password-based SSH access available, you will have to add your public key to the remote server manually.

On your local machine, you can find the contents of your public key file by typing:

```
cat ~/.ssh/id_rsa.pub
```

```
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQCqql6MzstZYh1TmWWv11q5O3pISj2ZFl9HgH1JLknLLx44+tXfJ7mIrKNxOOwxIxvcBF8PXSYvobFYEZjGIVCEAjrUzLiIxbyCoxVyle7Q+bqgZ8SeeM8wzytsY+dVGcBxF6N4JS+zVk5eMcV385gG3Y6ON3EG112n6d+SMXY0OEBIcO6x+PnUSGHrSgpBgX7Ks1r7xqFa7heJLLt2wWwkARptX7udSq05paBhcpB0pHtA1Rfz3K2B+ZVIpSDfki9UVKzT8JUmwW6NNzSgxUfQHGwnW7kj4jp4AT0VZk3ADw497M2G/12N0PPB5CnhHf7ovgy6nL1ikrygTKRFmNZISvAcywB9GVqNAVE+ZHDSCuURNsAInVzgYo9xgJDW8wUw2o8U77+xiFxgI5QSZX3Iq7YLMgeksaO4rBJEa54k8m5wEiEE1nUhLuJ0X/vh2xPff6SQ1BL/zkOhvJCACK6Vb15mDOeCSq54Cr7kvS46itMosi/uS66+PujOO+xt/2FWYepz6ZlN70bRly57Q06J+ZJoc9FfBCbCyYH7U/ASsmY095ywPsBo1XQ9PqhnN1/YOorJ068foQDNVpm146mUpILVxmq41Cj55YKHEazXGsdBIbXWhcrRf4G2fJLRcGUr9q8/lERo9oxRm5JFX6TCmj6kmiFqv+Ow9gI0x8GvaQ== demo@test
```

You can copy this value, and manually paste it into the appropriate location on the remote server. You will have to log into the remote server.

On the remote server, create the ~/.ssh directory if it does not already exist.

Afterward, you can create or append the ~/.ssh/authorized_keys file by typing:

```
echo public_key_string >> ~/.ssh/authorized_keys
```

---

## SSH-9: Basic Connection Instructions

**Connecting to a Remote Server**

`ssh remote_host`

You can set up the remote_host to be an actual name in your ~/.ssh/config files. See the Managing Ubuntu file for more information.

If your username is different on a remote server, you may need to pass the remote user's name like so:

`ssh user@remote_host`

First time connecting, you'll get a warning.

```
The authenticity of host '111.111.11.111 (111.111.11.111)' can't be established.
ECDSA key fingerprint is fd:fd:d4:f9:77:fe:73:84:e1:55:00:ad:d6:6d:22:fe.
Are you sure you want to continue connecting (yes/no)? yes
```

If you are using password authentication, you will be prompted for the password for the remote account here. If you are using SSH keys, you will be prompted for your private key's passphrase if one is set, otherwise you will be logged in automatically.

---

### SSH-10: Running a Single Command on a Remote Server

Instead of spawning a shell session, you can do this:

`ssh username@remote_host command_to_run`

eg.

`ssh my_remote_host 'touch ~/hello.txt'`

The connection immediately closes afterwards.

---

### SSH-11: Logging into a Server with a Different Port

By default the SSH daemon on a server runs on port 22. Your SSH client will assume that this is the case when trying to connect. If your SSH server is listening on a non-standard port (this is demonstrated in a later section), you will have to specify the new port number when connecting with your client.

You can do this by specifying the port number with the -p option:

`ssh -p port_num username@remote_host`

To avoid having to do this every time you log into your remote server, you can create or edit a configuration file in the ~/.ssh directory within the home directory of your local computer.

This can also be done in the config file.

```
Host remote_alias
    HostName remote_host
    Port port_num
```

---

### SSH-12: Adding your SSH Keys to an SSH Agent to Avoid Typing the Passphrase

If you have an passphrase on your private SSH key, you will be prompted to enter the passphrase every time you use it to connect to a remote host.

To avoid having to repeatedly do this, you can run an SSH agent. This small utility stores your private key after you have entered the passphrase for the first time. It will be available for the duration of your terminal session, allowing you to connect in the future without re-entering the passphrase.

This is also important if you need to forward your SSH credentials (shown below).

To start the SSH Agent, type the following into your local terminal session:

`eval $(ssh-agent)`

`Agent pid 10891`

This will start the agent program and place it into the background. Now, you need to add your private key to the agent, so that it can manage your key:

```
ssh-add

Enter passphrase for /home/demo/.ssh/id_rsa:
Identity added: /home/demo/.ssh/id_rsa (/home/demo/.ssh/id_rsa)
```

You will have to enter your passphrase (if one is set). Afterwards, your identity file is added to the agent, allowing you to use your key to sign in without having re-enter the passphrase again.

---

## SSH-13: Forwarding your SSH Credentials to Use on a Server

If you wish to be able to connect without a password to one server from within another server, you will need to forward your SSH key information. This will allow you to authenticate to another server through the server you are connected to, using the credentials on your local computer.

To start, you must have your SSH agent started and your SSH key added to the agent (see above). After this is done, you need to connect to your first server using the -A option. This forwards your credentials to the server for this session:

`ssh -A username@remote_host`

From here, you can SSH into any other host that your SSH key is authorized to access. You will connect as if your private SSH key were located on this server.

---

## SSH-14: Server-Side Configuration Options

This section will explain server-side config options and the way the server responds and what types of connection are allowed.

---

### SSH-15: Disabling Password Authentication

If you have SSH keys configured, tested, and working properly, it is probably a good idea to disable password authentication.

To do this, connect to your remote server and open the /etc/ssh/sshd_config file with root or sudo privileges:

```
sudo nano /etc/ssh/sshd_config
```

Inside of the file, search for the `PasswordAuthentication` directive. If it is commented out, uncomment it. Set it to "no" to disable password logins:

```
PasswordAuthentication no
```

After you save, you should restart the SSH service to implement changes:

```
sudo service ssh restart
#sshd on CentOS/Fedora
```

### SSH-16: Changing the Port that the SSH Daemon Runs On

---

**Definition: Daemon** A daemon is a computer program that runs as a background process rather than being in direct control of an interactive user. Traditionally, the process names of a daemon end with the letter d, for clarification that the process is, in fact, a daemon, and for differentiation between a daemon and a normal computer program. For example, syslogd is the daemon that implements the system logging facility, and sshd is a daemon that serves incoming SSH connections.

In a Unix environment, the parent process of a daemon is often, but not always, the init process. A daemon is usually either created by a process forking a child process and then immediately exiting, thus causing init to adopt the child process, or by the init process directly launching the daemon. In addition, a daemon launched by forking and exiting typically must perform other operations, such as dissociating the process from any controlling terminal (tty). Such procedures are often implemented in various convenience routines such as daemon(3) in Unix.

Systems often start daemons at boot time and serve the function of responding to network requests, hardware activity, or other programs by performing some task. Daemons can also configure hardware (like udevd on some Linux systems), run scheduled tasks (like cron), and perform a variety of other tasks.

---

Some administrators suggest that you change the default port that SSH runs on. This can help decrease the number of authentication attempts your server is subjected to from automated bots.

To change the port that the SSH daemon listens on, you will have to log into your remote server. Open the `sshd_config` file on the remote system with root privileges, either by logging in with that user or by using sudo:

`sudo nano /etc/ssh/sshd_config`

This is the same file that you would use to turn off the PasswordAuthentication property.

Once you are inside, you can change the port that SSH runs on by finding the Port 22 specification and modifying it to reflect the port you wish to use. For instance, to change the port to 4444, put this in your file:

```
#Port 22
Port 4444
```

Afterwards, run the `sudo service ssh restart` command

After the daemon restarts, you will need to authenticate by specifying the port number (demonstrated in SSH-11).

---

## SSH-17: Limiting the Users who can connect through SSH

To explicitly limit the user accounts who are able to login through SSH, you can take a few different approaches, each of which involve editing the SSH daemon config file.

On your remote server, open this file now with root or sudo privileges:

```
sudo nano /etc/ssh/sshd_config
```

The first method of specifying the accounts that are allowed to login is using the AllowUsers directive. Search for the AllowUsers directive in the file. If one does not exist, create it anywhere. After the directive, list the user accounts that should be allowed to login through SSH:

```
AllowUsers user1 user2
```

Save and close the file, and run `sudo service sshd restart`

If you are more comfortable with group management, you can use the `AllowGroups` directive instead. If this is the case, just add a single group that should be allowed SSH access (we will create this group and add members momentarily):

```
AllowGroups sshmembers
```

Save and close the file.

Now, you can create a system group (without a home directory) matching the group you specified by typing:

```
sudo groupadd -r sshmembers
```

Make sure that you add whatever user accounts you need to this group. This can be done by typing:

```
sudo usermod -a -G sshmembers user1
sudo usermod -a -G sshmembers user2
```

Now, restart the SSH daemon to implement your changes with `sudo service ssh restart`.

---

## SSH-18: Disabling Root Login

It is often advisable to completely disable root login through SSH after you have set up an SSH user account that has sudo privileges.

To do this, open the SSH daemon configuration file with root or sudo on your remote server.

```
sudo nano /etc/ssh/sshd_config
```

Inside, search for a directive called PermitRootLogin. If it is commented, uncomment it. Change the value to "no":

```
PermitRootLogin no
```

Save the file and run `sudo service ssh restart`

## SSH-19: Allowing Root Access for Specific Commands

There are some cases where you might want to disable root access generally, but enable it in order to allow certain applications to run correctly. An example of this might be a backup routine.

This can be accomplished through the root user's `authorized_keys` file, which contains SSH keys that are authorized to use the account.

Add the key from your local computer that you wish to use for this process (we recommend creating a new key for each automatic process) to the root user's `authorized_keys` file on the server. We will demonstrate with the `ssh-copy-id` command here, but you can use any of the methods of copying keys we discuss in other sections:

```
ssh-copy-id root@remote_host
```

For all the other methods on how to copy across the key:

<a href="#SSH-6">SSH-6 Copying with ssh-copy-id</a>
<a href="#SSH-7">SSH-7 Copying without ssh-copy-id</a>
<a href="#SSH-8">SSH-8 Manually adding the key</a>

Now, log into the remote server. We will need to adjust the entry in the authorized_keys file, so open it with root or sudo access:

```
sudo nano /root/.ssh/authorized_keys
```

At the beginning of the line with the key you uploaded, add a command= listing that defines the command that this key is valid for. This should include the full path to the executable, plus any arguments:

```
command="/path/to/command arg1 arg2" ssh-rsa ...
```

Save and close the file when you are finished.

Now, open the sshd_config file with root or sudo privileges:

```
sudo nano /etc/ssh/sshd_config
```

Find the directive PermitRootLogin, and change the value to forced-commands-only. This will only allow SSH key logins to use root when a command has been specified for the key:

```
PermitRootLogin forced-commands-only
```

Save and close the file. Restart the SSH daemon to implement your changes. `sudo service ssh restart`

---

<div id="SSH-20"></div>
## SSH-20: Forwarding X Application Displays to the Client

The SSH daemon can be configured to automatically forward the display of X applications on the server to the client machine. For this to function correctly, the client must have an X windows system configured and enabled.

To enable this functionality, log into your remote server and edit the sshd_config file as root or with sudo privileges:

```
sudo nano /etc/ssh/sshd_config
```

Search for the X11Forwarding directive. If it is commented out, uncomment it. Create it if necessary and set the value to "yes":

`X11Forwarding yes`

Save and restart `sudo service ssh restart`

To connect to the server and forward an application's display, you have to pass the -X option from the client upon connection:

```
ssh -X username@remote_host
```

Graphical applications started on the server through this session should be displayed on the local computer. The performance might be a bit slow, but it is very helpful in a pinch.

---

<div id="SSH-21"></div>
## SSH-21: Client Side Configuration Options

**Defining Server-Specific Connection Info**

On your local computer, you can define individual configurations for some or all of the servers you connect to. These can be stored in the ~/.ssh/config file, which is read by your SSH client each time it is called.

Create or open this file in your text editor on your local computer:

```
nano ~/.ssh/config
```

Inside, you can define individual configuration options by introducing each with a Host keyword, followed by an alias. Beneath this and indented, you can define any of the directives found in the ssh_config man page:

```
man ssh_config
```

An example configuration would be:

```
Host testhost
    HostName example.com
    Port 4444
    User demo
```

You could then connect to example.com on port 4444 using the username "demo" by simply typing:

```
ssh testhost
```

You can also use wildcards to match more than one host. Keep in mind that later matches can override earlier ones. Because of this, you should put your most general matches at the top. For instance, you could default all connections to not allow X forwarding, with an override for example.com by having this in your file:

```
Host *
    ForwardX11 no

Host testhost
    HostName example.com
    ForwardX11 yes
    Port 4444
    User demo
```

Save and close the file when you are done.

---

<div id="SSH-22"></div>
### SSH-22: Keep Connections Alive to Avoid Timeout

If you find yourself being disconnected from SSH sessions before you are ready, it is possible that your connection is timing out.

You can configure your client to send a packet to the server every so often in order to avoid this situation:

On your local computer, you can configure this for every connection by editing your ~/.ssh/config file.

If one does not already exist, at the top of the file, define a section that will match all hosts. Set the ServerAliveInterval to "120" to send a packet to the server every two minutes. This should be enough to notify the server not to close the connection:

```
Host *
    ServerAliveInterval 120
```

Save and close.

---

<div id="SSH-23"></div>
## SSH-23: Disabling Host Checking

By default, whenever you connect to a new server, you will be shown the remote SSH daemon's host key fingerprint.

```
The authenticity of host '111.111.11.111 (111.111.11.111)' can't be established.
ECDSA key fingerprint is fd:fd:d4:f9:77:fe:73:84:e1:55:00:ad:d6:6d:22:fe.
Are you sure you want to continue connecting (yes/no)? yes
```

This is configured so that you can verify the authenticity of the host you are attempting to connect to and spot instances where a malicious user may be trying to masquerade as the remote host.

In certain circumstances, you may wish to disable this feature. Note: This can be a big security risk, so make sure you know what you are doing if you set your system up like this.

To make the change, the open the ~/.ssh/config file on your local computer.

If one does not already exist, at the top of the file, define a section that will match all hosts. Set the StrictHostKeyChecking directive to "no" to add new hosts automatically to the known_hosts file. Set the UserKnownHostsFile to /dev/null to not warn on new or changed hosts:

```
Host *
    StrictHostKeyChecking no
    UserKnownHostsFile /dev/null
```

You can enable the checking on a case-by-case basis by reversing those options for other hosts. The default for StrictHostKeyChecking is "ask":

```
Host *
    StrictHostKeyChecking no
    UserKnownHostsFile /dev/null
```

```
Host testhost
    HostName example.com
    StrictHostKeyChecking ask
    UserKnownHostsFile /home/demo/.ssh/known_hosts
```

---

<div id="SSH-24"></div>
### SSH-24: Multiplexing SSH Over a Single TCP Connection

---

**Definition: Multiplexing**

Generally speaking, multiplexing is the ability to carry multiple signals over a single connection. Similarly, SSH multiplexing is the ability to carry multiple SSH sessions over a single TCP connection. [This Wikibook article](https://en.wikibooks.org/wiki/OpenSSH/Cookbook/Multiplexing) goes into more detail on SSH multiplexing; in particular, I would call your attention to the table under the “Advantages of Multiplexing” to better understand the idea of multiple SSH sessions with a single TCP connection.

---

There are situations where establishing a new TCP connection can take longer than you would like. If you are making multiple connections to the same machine, you can take advantage of multiplexing.

SSH multiplexing re-uses the same TCP connection for multiple SSH sessions. This removes some of the work necessary to establish a new session, possibly speeding things up. Limiting the number of connections may also be helpful for other reasons.

To set up multiplexing, you can manually set up the connections, or you can configure your client to automatically use multiplexing when available. We will demonstrate the second option here.

To configure multiplexing, edit your SSH client's configuration file on your local machine:

```
nano ~/.ssh/config
```

If you do not already have a wildcard host definition at the top of the file, add one now (as Host \*). We will be setting the `ControlMaster, ControlPath, and ControlPersist` values to establish our multiplexing configuration.

The `ControlMaster` should be set to "auto" in able to automatically allow multiplexing if possible. The `ControlPath` will establish the path to control socket. The first session will create this socket and subsequent sessions will be able to find it because it is labeled by username, host, and port.

Setting the `ControlPersist` option to "1" will allow the initial master connection to be backgrounded. The "1" specifies that the TCP connection should automatically terminate one second after the last SSH session is closed:

```
Host *
    ControlMaster auto
    ControlPath ~/.ssh/multiplex/%r@%h:%p
    ControlPersist 1
```

Save and close the file when you are finished. Now, we need to actually create the directory we specified in the control path:

```
mkdir ~/.ssh/multiplex
```

Now, any sessions that are established with the same machine will attempt to use the existing socket and TCP connection. When the last session exists, the connection will be torn down after one second.

If for some reason you need to bypass the multiplexing configuration temporarily, you can do so by passing the -S flag with "none":

```
ssh -S none username@remote_host
```

---

<div id="SSH-25"></div>
## SSH-25: Setting Up SSH Tunnels

// todo

---

<div id="UBU-1"></div>
## UBU-1: Installing Ubuntu onto VirtualBox

// todo
