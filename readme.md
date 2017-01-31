

# Planai
    
1. Automatinis serverių paruošimas. Automatizuoti naujų VPS paruošimą: suinstaliuoti reikalingas programas, paruošti duomenis etc.
2. Pridėti SSH prisijungimą vartotojams apribotą naudojant virtualizaciją ar kažkokį Linux container(chroot neužtenka).


# Serverio paruošimas

1. web serveris
2. Ssh key
3. mysql serveris
4. disable mysql root from remote
4. pma
5. php
6. disable root password login
7. setup quotas (https://debian-administration.org/article/47/Limiting_your_users_use_of_disk_space_with_quotas http://www.thegeekstuff.com/2010/07/disk-quota/ https://www.digitalocean.com/community/tutorials/how-to-enable-user-and-group-quotas)
8. setup crona su `repquota -a` kad gauti quotos raportus.