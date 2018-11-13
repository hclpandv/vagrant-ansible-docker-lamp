# Vagrant/Ansible/Docker Exercise
**Objective**  
Create a Vagrant setup for two nodes. Use Ansible as provider on both nodes.  
Ansible will first install Docker on both nodes and then configure the two nodes as follow:  
On Node1 you must install a LAMP stack in a stack of Docker containers. You must use Apache as web server. MySql or MariaDB as DB. PHP version 7 or higher.  
On Node2 you must install Redis.  
The Linux base image can be either Debian, Ubuntu or Centos.  
The hostname on Node1 must be 'server1' and the hostname in Node2 must be 'server2'.  
You decide what IP addresses to assign to the Vagrant nodes, but those addresses must be present in the documentation file, readme.md.
We expect everything to work just launching `vagrant up`.  
We expect that the default apache home page can be reached by browsing to the server1 IP address in a browser from the host machine.  
We expect Redis to be configured as a PHP session handler for sessions on server1. This configuration must be working.  
We expect server2 to be secured such that only connections from server1 are allowed.  
We expect both server to have a basic fail2ban configuration that blocks an IP after 3 failed SSH login attempts. 
# Solution 
1. Clone this repo.
```
git clone https://vikiscripts@bitbucket.org/vikiscripts/vagrant-ansible-docker-lamp.git
```
2. Execute the command
```
vagrant up
```
3. Browse for http://10.10.10.20 to say Hello to the World :).  
  
![web_app_output](https://user-images.githubusercontent.com/13016162/48359600-4d053c00-e6c3-11e8-9c87-14e13a8feb72.JPG)

**Implementation**

* The Vagrant with virtualbox provider and ansible provisioner is used to achieve the goal.
* Solution is develpoed and tested on a Windows 10 workstation.
* `Vagrant up` spins up two VM's `server1[IP: 10.10.10.20, HOSTNAME: server1]` and `server2[IP: 10.10.10.30, HOSTNAME: server2]`
* The ansible provisioner uses `./server1/deploy.yml` and `./server2/deploy.yml` as ansible playbooks for servers respectively.  
* The server1 playbook Installs `docker` and few more dependency packages to create lamp stack in a seperate docker containers
* Below screenshot shows the result of playbook as lamp containers on server1:  
![server1_dockers_running_output](https://user-images.githubusercontent.com/13016162/48359593-4bd40f00-e6c3-11e8-96d0-daf42fa58588.jpg)
* The ansible playbook use `docker_service` module to utilize `docker_compose.yml` to get the containers up and running.
* A simple php web application is used to query a greetings string `Hellow World` from `mysql` db container and shows as output. 
* Below screen shot shows the php application and apache server in action :  
![server1_apache_output](https://user-images.githubusercontent.com/13016162/48359592-4bd40f00-e6c3-11e8-8caf-0fd996c282bf.jpg)
  
* The server2 playbook Installs `docker` and few more dependency packages to create a docker conatainer of redis server.
* Below screenshot shows the result of playbook as redis container on server2:  
![server2_dockers_running_output](https://user-images.githubusercontent.com/13016162/48359594-4bd40f00-e6c3-11e8-984e-b10305234301.jpg)
      
* A `test.php` page added showing a php session counter. can be browsed at http://10.10.10.20/test.php
        
![php_session_count_output](https://user-images.githubusercontent.com/13016162/48359575-424aa700-e6c3-11e8-9f20-c8443aae7564.JPG)  

* The sessions are stored in redis. refer the below output 
	  
![redis_server_output](https://user-images.githubusercontent.com/13016162/48359591-4b3b7880-e6c3-11e8-9dde-23cfb7d27475.jpg)

* Ansible playbook on server2 uses `iptables` to block ssh traffic on server2 except server1(10.10.10.20) to achieve security task
	    
![server2_traffic22_iptables_output](https://user-images.githubusercontent.com/13016162/48359597-4c6ca580-e6c3-11e8-9520-6f8a2c055259.jpg)

![server2_traffic22_dropped_output](https://user-images.githubusercontent.com/13016162/48359595-4c6ca580-e6c3-11e8-85f5-ac09a1bc2fb2.jpg)  
  
* A basic fail2ban configuration added to both of these servers to block an IP after 3 failed SSH login attempts

# Improvement oportunities

* Ansible roles can be used if we have well tested and re-usable ansible roles as per the Environment.
