VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "trusty64"

  config.vm.network :private_network, ip: "192.168.192.119"

  config.vm.synced_folder ".", "/home/vagrant/project", nfs: true

  config.vm.provider :virtualbox do |vb|
     vb.gui = true
     vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

  config.vm.provider :vmware_fusion do |v|
      v.vmx["memsize"] = "1024"
      v.vmx["numvcpus"] = "2"
  end

  config.vm.provision :shell, :inline => "echo -e '#{File.read("#{Dir.home}/.ssh/id_rsa")}' > '/home/vagrant/.ssh/id_rsa'"
  config.vm.provision :shell, :inline => "echo -e '#{File.read("#{Dir.home}/.gitconfig")}' > '/home/vagrant/.gitconfig'"
  config.vm.provision :shell, :path => "bootstrap.sh"

end
