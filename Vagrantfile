# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
	# create bots-dev
	config.vm.define :bots do |bots_config|
		bots_config.vm.box = "ubuntu/trusty64"
		bots_config.vm.hostname = "bots-dev"
		bots_config.vm.network :private_network, ip: "10.0.15.11"
		bots_config.vm.network "forwarded_port", guest: 22, host: 4023
		bots_config.vm.provider "virtualbox" do |vb|
			vb.memory = "256"
		end

		# Shared folder from the host machine to the guest machine. NFS provides much better performance
		bots_config.vm.synced_folder ".", "/usr/local/selfportraitexe", type: "nfs", mount_options: ['rw', 'vers=3', 'tcp', 'fsc']
		bots_config.vm.synced_folder "./opt", "/var/opt/selfportraitexe", type: "nfs", mount_options: ['rw', 'vers=3', 'tcp', 'fsc']
	end

	config.vm.provision "shell" do |s|
      ssh_pub_key = File.readlines("#{Dir.home}/.ssh/id_rsa.pub").first.strip
      s.inline = <<-SHELL
        echo #{ssh_pub_key} >> /home/vagrant/.ssh/authorized_keys
      SHELL
    end
end
