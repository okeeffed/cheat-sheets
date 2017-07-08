# SysOps

## Networking

### Networking Bottlenecks

Increase network performance = increase instance size.

EBS Throughput != network throughput. This is writing to disk as opposed to EC2 talking to each other within the same subnet.

### DNS 101

DNS is used to convert human friendly domains to an `Internet Protocol (IP)`.

IPv4 is a 32 bit field and has 42 billion addresses.

IPv6 has an address space of 128 bits. 340 undecillion addresses.

The big issue at the moment is that everyone is still using IPv4 - this is driven by ISPs.

Amazon previously did not have IPv6 support for backend systems. This changed around 2016.

#### Top Level Domains

The last word in the domain name is the top level eg. `.com`, `.edu`, `.gov` etc.

These are controlled by the `Internet Assigne Numbers Authority (IANA)` in a root zone database which is essentially a database of all available top level domains.

#### Domain Registrars

As all of these need to be unique, the domain registrar is an authority that can assign domain names directly under one or more top-level domains. These domains are registered with InterNIC, a service of ICANN, which enforces the uniqueness of domain names across the internet.

Each domain becomes registered in a central database known as the `WhoIS database`.

#### SOA Records

- `Start of Authority`
- Name of the server that suppised the data for the zone.
- The administrator of the zone. (The owner)
- Current version of the data file
- Number of seconds a secondary name server should wait before checking for updates etc.
- Default TTL file on resource records

#### NS Records

- `Name Server records` - used by `Top Level Domain` servers to direct traffic to the Content DNS server which contains the authoritative DNS records.

#### A Records

The "A" record is the fundamental type of DNS record. It stands for "Address". The A record is use by a computer to translate the name of the domain to the IP address.

#### TTL Record

`Time to Live` - the length of time that the DNS server is cached either on the server or you PC.

DNS records take time to propagate throughout the internet. Companies before a migration, they will drop the TTL down low.

## Definitions

|			|									|
|		---	|								---	|
| ENI		| Elastic Network Interface			|
| EBS	 	| Elastic Block Store				|
| DNS		| Domain Name System				|

