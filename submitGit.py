# To run type python3 submitGit.py
# made by Brandon Gage
from subprocess import call
m = input("Commit message?")
call(['git', 'pull'])
call(['git', 'add', '--all'])
call(['git', 'commit', '-m', m])
call(['git','push'])
