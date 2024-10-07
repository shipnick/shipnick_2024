# Github Actions




## Self-hosted runner

- **Path** ```/home/ec2-user/action-runner```

### Runner Commands
- Start Interactive ```cd action-runner && ./run.sh```
- As a service ```./svc.sh install``` ```./svc.sh uninstall```
- As a service ```./svc.sh start``` ```./svc.sh stop```

### Docker auto start after Reboot
- ```sudo systemctl enable docker```