# Managing a Ubuntu Server Help Sheet

Credit to Jack Moggach

This document gives a brief overview of how an Ubuntu server works. Most of this is applicable to any Linux-like OS but

By the end of it you should have a better idea of:

- How to access a Linux server
- What is (and when to) sudo
- How to install software
- Where software config is stored
- How to start/stop/restart services

## Ubuntu

Ubuntu is the most popular Linux server distribution at the time of writing. This is unlikely to change anytime soon. This distro is well supported, has loads of great docs and is easy + free to use with Amazon Web Services.

### Choosing a version

** Four Main Choices **

- **OS Type**
	- Desktop for a workstation
	- Server for a server (bare-bones OS without a GUI)

- **Flavour**
	- Vanilla Ubuntu is fine for our purposes
	- They also tailor the OS for education, multimedia etc. (http://www.ubuntu.com/download/ubuntu-flavours)

- **Architecture**
	- i386 = 32bit
	- amd64 = 64bit

- **Version**
	- 16.04.1 is the latest
	- Our servers use 14.04
	- Always best to get an LTS version (more information provided later)

Mostly run on 64-bit version with the latest releases

### Why LTS?

LTS: Long Term Support

A new Ubuntu version is released every 6 months. Non-LTS versions have support for 9 months after they are superseded. If you were to use a non-LTS version of Ubuntu on a server. Using the latest non-LTS release will give you the latest and greatest packages but you have less time before you need to upgrade your OS.

As an example PHP 5.5 is the version of PHP installed in Ubuntu 14.04. It was deprecated in July 2016. This means it will no longer receive any more support or security patches from PHP. This is terrible news if you have a server running PHP as it is a frequent target for would-be hackers. As Ubuntu 14.04 is an LTS release with support until 2019 the Ubuntu security team will 'backport' security fixes for PHP 5.5 until Ubuntu 14.04 is deprecated. You can spend way less time mucking around with your hosting environment if you just stick with LTS releases.

### Ubuntu 16.0.4?

A new LTS version of Ubuntu came out recently. I haven't rushed to adopt it as it sometimes takes a little while to work the kinks out of it. Ideally all developers and servers would be running the same package versions (Node, PHP etc.). Given the latest Ubuntu version uses PHP 7 we'd need to move everyone to that version locally, test all of our code and then update all of our servers. It's quite a big job and we don't need to rush.

### Getting familiar with Ubuntu

The best way to get familiar with Ubuntu is to create a virtual machine. You have two options here:
- Download a pre-built Ubuntu Virtual Machine
- Install Ubuntu from the installation media

The first option is quicker but the second gives you a lot more control as you can configure everything to your liking.

You can follow pretty much all of the default prompts but make sure you install openssh-server so you can log in to the machine.

***
__SSH-Server Installation__

Installation
Installation of the OpenSSH client and server applications is simple. To install the OpenSSH client applications on your Ubuntu system, use this command at a terminal prompt:

`sudo apt install openssh-client`

To install the OpenSSH server application, and related support files, use this command at a terminal prompt:

`sudo apt install openssh-server`
The openssh-server package can also be selected to install during the Server Edition installation process.

***

Note: You'll probably want to put the Virtual Machine in Bridged Adapter Mode for networking. You can do this by going to Settings → Network → Adapter 1 and changing the 'Attached to' option. You'll need to restart the virtual machine after making that change.

# Connecting to a Server using SSH

You'll need to use SSH to connect to a running instance. Here's a pretty standard connection string:

```bash
$ ssh user@127.0.0.1
```
This will attempt a login to the server at 127.0.0.1 with username user. You'll be asked to enter your password.

If you want to save common ssh connections you can edit ~/.ssh/config. The same connection could be saved as...
```
Host my-ubuntu-server
	hostname 127.0.0.1
	user ubuntu
```

Now the connection becomes
```
$ ssh my-ubuntu-server
```

## Finding your Virtual Machine IP Address

To get the IP address of your virtual machine you'll need to use the command ifconfig. Look for the eth0 interface (the primary ethernet adapter).

The bit you're interested in is the inet addr (10.240.112.151). Once you have this you can now ssh into your machine w/out worrying about that horrible console.

## Running commands as Root

To run commands as root simply prepend `sudo` to the command.

Pretty much any package installation, config change or service restart is going to need it.
