### Question 1
  
##### Ans : 1,2,3,4,6 (All options except "ac")
  
  
### Question 2
  
##### Ans : Below command can be executed to achieve.(can be adjusted to `.bashrc` file to load in user's profile)
```bash
cd /usr/local/src/
export PS1="\u@\h:\w\\$"
```
### Question 3
  
##### Ans : Below is the modified script post fixing.

```bash
#!/bin/bash

stars=(Andromeda Circunus Lupus Sagitta Virgo)

for (( i=0; i<${#stars[@]}; i++ ))
do
  echo ${stars[i]}
done
echo
printf "%s\n" "${stars[@]}"
```
### Question 4
  
##### Ans : Below command

```bash
sed -i "s/PROJECT/${PROJECT}/g" /etc/hosts
```
### Question 5
  
##### Ans : Below command
```bash
sed 's/^M$//' input.txt > output.txt
```
### Question 6
  
##### Ans : Below command
```bash
cut -f 3,4 -d: /etc/passwd
```
### Question 7
  
##### Ans : Below command
```bash
find /var -printf '%s %p\n' | sort -nr | head -10
```

### Question 8
  
##### Ans : Use below script as `/path/of/scr.sh`
```bash
#!/bin/bash

tar cvf "/var/log/maillog_archive_$(date +'%d%m%Y').tar.gz" /var/log/mail.log
rm /var/log/mail.log
touch /var/log/mail.log
```
Execute `crontab -e` and append below line 

```
* 1 * * 7 /path/of/scr.sh
```

### Question 9
  
##### Ans : Below command
```bash
ps -ef | grep apache2 | awk '{print $2}'
```




