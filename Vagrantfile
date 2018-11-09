# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  #------------------------------------------------------------
  #------ Creating VM: a webserver with lamp stack (Dockerized)
  #------------------------------------------------------------
  config.vm.define "server1" do |server1|
    server1.vm.box = "ubuntu/trusty64"
    server1.vm.hostname = 'server1'
    # Assigning IP:
    server1.vm.network "private_network", ip: "10.10.10.20"
    #------ Using Virtualbox provider for the exercise
    server1.vm.provider "virtualbox" do |vb|
      vb.gui = false
      vb.customize ["modifyvm", :id, "--name", "server1"]  
      # Customize the amount of memory on the VM:
      vb.memory = "512"      
    end
    #------ Provisioning through Ansible as per guidelines in exercise
    server1.vm.provision "ansible_local" do |ansible|
      ansible.install = true
      ansible.playbook = "provisioning/server1_deploy.yml"
      ansible.verbose = 'v'
    end
  end
  #-----------------------------------------------------------
  #------ Creating VM: a Redis server as PHP session handeller
  #-----------------------------------------------------------
  config.vm.define "server2" do |server2|
    server2.vm.box = "ubuntu/trusty64"
    server2.vm.hostname = 'server2'
    # Assigning IP:
    server2.vm.network "private_network", ip: "10.10.10.30"
    #------ Using Virtualbox provider for the exercise
    server2.vm.provider "virtualbox" do |vb|
      vb.gui = false
      vb.customize ["modifyvm", :id, "--name", "server2"]
      # Customize the amount of memory on the VM:
      vb.memory = "512"
    end
    #------ Provisioning through Ansible as per guidelines in exercise
    server2.vm.provision "ansible_local" do |ansible|
      ansible.install = true
      ansible.playbook = "provisioning/server2_deploy.yml"
      ansible.verbose = 'v'
    end
  end  
end
