# AWS Guide

<!-- TOC -->

*   [AWS Guide](#aws-guide)
    *   [AWS-1: Connecting to your instance](#aws-1-connecting-to-your-instance)
    *   [AWS-2: Transferring Files to Linux Instances from Linux Using SCP](#aws-2-transferring-files-to-linux-instances-from-linux-using-scp)
    *   [AWS-3: Changing the Hostname of Your Linux System](#aws-3-changing-the-hostname-of-your-linux-system)
    *   [AWS-4: To change the system hostname to a public DNS name](#aws-4-to-change-the-system-hostname-to-a-public-dns-name)
    *   [AWS-5: To change the system hostname without a public DNS name](#aws-5-to-change-the-system-hostname-without-a-public-dns-name)
    *   [AWS-6: Changing the Shell Prompt without affecting the Hostname](#aws-6-changing-the-shell-prompt-without-affecting-the-hostname)
    *   [AWS-7: How do I assign a static hostname to a private Amazon EC2 instance running Ubuntu Linux?](#aws-7-how-do-i-assign-a-static-hostname-to-a-private-amazon-ec2-instance-running-ubuntu-linux)

<!-- /TOC -->

**Sources**

[Connecting to your Linux Instance](http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/AccessingInstancesLinux.html)

## AWS-1: Connecting to your instance

**Prerequisites**

1.  Install an SSH client

The instance likely already has one. Head to OpenSSH otherwise. Check with `ssh`.

2.  Install the AWS CLI Tools

3.  Get the ID of the instance

4.  Get the public DNS of the instance

5.  Locate the private key

6.  Enable inbound SSH traffic from your IP address to your instance

Your default security group does not allows SSH by default.

**To Connect**

`aws ec2 get-console-output --instance-id <instance_id>`

Ensure that the instance is in the running state and change directories to your pem key file.

Use `chmod` to make sure that your private key file isn't publicly viewable.

```
chmod 400 /path/my-key-pair.pem
```

For Ubuntu, the user name is unbuntu - connect to this instance using

```
ssh -i /path/my-key-pair.pem ec2-user@ec2-198-51-100-1.compute-1.amazonaws.com
```

Refer to SSH-Intro.md SSH-7 in order to understand how to copy your computer's auth and add the host to ~/.ssh/config in order to be able to access the server without continually having to add in the key and move the file every time.

---

<div id="AWS-2"></div>
## AWS-2: Transferring Files to Linux Instances from Linux Using SCP

In order to use a GUI, I recommend using a SFTP Client like FileZilla or Cyberduck. I'll add links these guides another time... Just Google it!

One way to transfer files between your local computer and a Linux instance is to use Secure Copy (SCP). This section describes how to transfer files with SCP. The procedure is very similar to the procedure for connecting to an instance with SSH.

**Prerequisites**

_Similar to AWS-1_

1.  Install a SCP client
2.  Get the ID of the instance
3.  Get the public DNS name of the instance
4.  Locate the private key
5.  Enable inbound SSH traffic from your IP address to your instance

**To use SCP to transfer a file**

```
scp -i /path/my-key-pair.pem /path/SampleFile.txt ec2-user@ec2-198-51-100-1.compute-1.amazonaws.com:~
```

---

<div id="AWS-3"></div>
## AWS-3: Changing the Hostname of Your Linux System

When you launch an instance, it is assigned a hostname that is a form of the private, internal IP address.

A typical Amazon EC2 private DNS name looks something like this: ip-12-34-56-78.us-west-2.compute.internal, where the name consists of the internal domain, the service (in this case, compute), the region, and a form of the private IP address. Part of this hostname is displayed at the shell prompt when you log into your instance (for example, ip-12-34-56-78).

Each time you stop and restart your Amazon EC2 instance (unless you are using an Elastic IP address), the public IP address changes, and so does your public DNS name, system hostname, and shell prompt. Instances launched into EC2-Classic also receive a new private IP address, private DNS hostname, and system hostname when they're stopped and restarted; instances launched into a VPC don't.

**! Important**
These procedures are intended for use with Amazon Linux. For more information about other distributions, see their specific documentation.

**Changing the System Hostname**

If you have a public DNS name registered for the IP address of your instance (such as webserver.mydomain.com), you can set the system hostname so your instance identifies itself as a part of that domain. This also changes the shell prompt so that it displays the first portion of this name instead of the hostname supplied by AWS (for example, ip-12-34-56-78). If you do not have a public DNS name registered, you can still change the hostname, but the process is a little different.

---

<div id="AWS-4"></div>
## AWS-4: To change the system hostname to a public DNS name

Follow this procedure if you already have a public DNS name registered.

1.  On your instance, open the /etc/sysconfig/network configuration file in your favorite text editor and change the HOSTNAME entry to reflect the fully qualified domain name (such as webserver.mydomain.com).

```
HOSTNAME=<webserver.mydomain.com>
```

2.  Reboot the instance to pick up the new hostname.

```
[ed2-user ~]$ sudo reboot
```

3.  Log into your instance and verify that the hostname has been updated. Your prompt should show the new hostname (up to the first ".")

```
$ hostname
webserver.mydomain.com
```

---

<div id="AWS-5"></div>
## AWS-5: To change the system hostname without a public DNS name

1.  Open the /etc/sysconfig/network configuration file in your favorite text editor and change the HOSTNAME entry to reflect the desired system hostname (such as webserver).

```
HOSTNAME=<webserver.mydomain.com>
```

2.  Open the `/etc/hosts` file in your favorite text editor and change the entry beginning with 127.0.0.1 to match the example below, substituting your own hostname.

```
127.0.0.1 webserver.localdomain webserver localhost localhost.localdomain
```

3.  Reboot the instance to pick up the new hostname.

```
[ec2-user ~]$ sudo reboot
```

4.  Log into your instance and verify that the hostname has been updated. Your prompt should show the new hostname (up to the first ".")

```
$ hostname
webserver.mydomain.com
```

## AWS-6: Changing the Shell Prompt without affecting the Hostname

If you do not want to modify the hostname for your instance, but you would like to have a more useful system name (such as webserver) displayed than the private name supplied by AWS (for example, ip-12-34-56-78), you can edit the shell prompt configuration files to display your system nickname instead of the hostname.

**To change the shell prompt to a host nickname**

1.  Create a file in /etc/profile.d that sets the environment variable called NICKNAME to the value you want in the shell prompt. For example, to set the system nickname to webserver, execute the following command.

```
[ec2-user ~]$ sudo sh -c 'echo "export NICKNAME=webserver" > /etc/profile.d/prompt.sh'
```

2.  Open the `/etc/bashrc` file in your favorite text editor (such as vim or nano). You need to use sudo with the editor command because `/etc/bashrc` is owned by root.

3.  Edit the file and change the shell prompt variable (PS1) to display your nickname instead of the hostname. Find the following line that sets the shell prompt in /etc/bashrc (several surrounding lines are shown below for context; look for the line that starts with [ "$PS1"):

```
# Turn on checkwinsize
shopt -s checkwinsize
[ "$PS1" = "\\s-\\v\\\$ " ] && PS1="[\u@\h \W]\\$ "
# You might want to have e.g. tty in prompt (e.g. more virtual machines)
# and console windows
```

And change the \h (the symbol for hostname) in that line to the value of the NICKNAME variable.

```
# Turn on checkwinsize
shopt -s checkwinsize
[ "$PS1" = "\\s-\\v\\\$ " ] && PS1="[\u@$NICKNAME \W]\\$ "
# You might want to have e.g. tty in prompt (e.g. more virtual machines)
# and console windows
```

(Optional) To set the title on shell windows to the new nickname, complete the following steps.

    a. Create a file called /etc/sysconfig/bash-prompt-xterm.

    ```
    [ec2-user ~]$ sudo touch /etc/sysconfig/bash-prompt-xterm
    ```

    b. Make the file executable with the following command.

    ```
    [ec2-user ~]$ sudo chmod +x /etc/sysconfig/bash-prompt-xterm
    ```

    c. Open the /etc/sysconfig/bash-prompt-xterm file in your favorite text editor (such as vim or nano). You need to use sudo with the editor command because /etc/sysconfig/bash-prompt-xterm is owned by root.

    d. Add the following line to the file.
    ```
    echo -ne "\033]0;${USER}@${NICKNAME}:${PWD/#$HOME/~}\007"
    ```

Log out and then log back in to pick up the new nickname value.

## AWS-7: How do I assign a static hostname to a private Amazon EC2 instance running Ubuntu Linux?

The Linux hostname command can be used by administrators to change the hostname of an EC2 Linux instance. If you want the new hostname to persist between instance stops/starts and reboots, you must add the new hostname to the appropriate configuration files on your EC2 Linux instance.

1.  Update the /etc/hosts file on your Ubuntu Linux instance with the new hostname, and add IPv6 configuration data if your instance is using IPv6.
    sudo vim /etc/hosts
    Change the name associated with the IP address 127.0.0.1 to the hostname that you want the instance to use even after a restart or reboot. Typically this involves changing localhost to the new hostname.
    127.0.0.1 persistent_host_name
    Add the following configuration information to the hosts file if the instance uses IPv6.
    ::1 ip6-localhost ip6-loopback
    fe00::0 ip6-localnet
    ff00::0 ip6-mcastprefix
    ff02::1 ip6-allnodes
    ff02::2 ip6-allrouters
    ff02::3 ip6-allhosts
    Save and exit the vim editor.
    Note
    After making this change, press SHIFT + : [colon] to open a new command entry box in the vim editor. Type wq, and then press Enter to save changes and exit vim.

2.  Update the /etc/hostname file on your Ubuntu Linux instance with the new hostname.

```
sudo vim /etc/hostname
```

Save and exit the vim editor. You can also use nano.

3.  If you have not already done so, run the Linux hostname command and specify the new hostname if you want to begin using the new hostname without restarting.

    `sudo hostname persistent_host_name`

4.  The next time that you restart or reboot the EC2 instance, run the Linux hostname command again without any parameters to verify that the hostname change persisted.

    `hostname`

The command should return the new hostname.

     `persistent_host_name`
