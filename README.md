# Yii_migrator
Creating automatic migrations in existing projects

### What's included
```
Yii_migrator
  ├── migrator
  ├── migrator.bat
  └── migrator.php
```
### Screenshots
1\)![png tester1][pngtester1] 2\)![png tester2](data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHoAAABkCAYAAABJhSQPAAAACXBIWXMAAAsTAAALEwEAmpwYAAADf0lEQVR42u3dW2vTYBzH8eeUPDm0adN2adeddNMpo2ObXoypsDvFd+WbEfRSUUHvxIFOEXG7UEFR5xybulO3tU3XpF4JIiJ43Pw/v+8LKP3nQ54nIaTlC2fOXGKIfAKHANAI0AjQCNAI0AjQCNAI0AjQgEaARoBGgEaARoBGgEaARoBGgAY0AjQCNAI0AjQCNAI0AjQCNKARoBGgEaARoNE/T+EQHL4SwXhsCbnrKWvHU3bdV3rHV3rPlXrPkbqppY5tYXUkVx3JZSo4Z4wxkXa7KukmKul2dDvdd+Mk9ltJ7DeTGNAHXFML+Slnu6slnVkpOfm1og5bttC/8lmp4LwtuGhbzGo40t1kFs7ogyjljNV9ZS9V3OB11Su97XUrWLqJFFtcLEdu9vmRTPSq3+vDHk2oli3k66qXWzie7V8r6AIuxogty+/KbvbxydzActmJcNVNrIYW6uloED0ay4/i9opg64GlH4yHgwe57wL6L/YhtN17k4Xh95HT8z99b0D/xBl891Rx5DDuv4D+AzW1kHMThaFnRzOD//McgP5BT0aD6N5UYYzCLID+Th/ztnPzXFSr+ypDZSZAf3MvPF/LVw/7rRKgf6NtX9nXZsvjW1krS3E+QDPGXgz64e2ZngnKMxoPfXeqMPh0NBimPqex0G3FxfXZythKSZdMmNdI6B1XWlcu9J1uauGYMrNx0OuBpS9f7JsxbW6joD+EtnvlfHXaxFVMABnQpJZrk5GNgN51pDJxTzYKuiM5v3q+epoh2tA3zkUn91zpgpkw9P3xfHWp4pZBTBj6bcXNUnwCBeivatlCXpstY1+mDn1nuucYWIlDv+z3cm+qbi9YCUO3FRe3zkZTICUOPV8L+8BJHLruKevJiWAEnMSh5ybDI6AkDr2VUfbLAR/LNnXo+Vo4AEbi0E0t5IshH9DUoRdHggiEBkA/rOWPg5A49GpBeynHD+KRh148lsUjSOrQKWfs2dHMEPiIQ28ElgM6A6Df9Ho50BkA/arfw20VdeiUM7ZW1EXQEYduaIl3uk2A3sjhQswI6PWc7YHNAOjNwAK0CdBbGUAbAb3r4RUbI6BbWtpgMwC6rbgFNgOgv/z1DyIOLdJuF2wGQNud7j7YDIB24qQNNgOgM42kCTYDoPO7+w2wGQAd1gFtBHRxuw1oE6AL2/stsBkA7cVJB2w/32c7r8DNq/e3jAAAAABJRU5ErkJggg==)

_1\) the referenced base64 block stops being parsed right at the point where 'a new chunk of image' starts, the green part `... So4Z4wxkXa7KukmKul2dDvd ...`  
2\) by passing the block directly we get the whole image_

This was tested with http://tmpvar.com/markdown.html. I don't know how it behaves on github. [The issue](https://github.com/github/markup/issues/270) has been already well discussed.

[pngtester1]:data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHoAAABkCAYAAABJhSQPAAAACXBIWXMAAAsTAAALEwEAmpwYAAADf0lEQVR42u3dW2vTYBzH8eeUPDm0adN2adeddNMpo2ObXoypsDvFd+WbEfRSUUHvxIFOEXG7UEFR5xybulO3tU3XpF4JIiJ43Pw/v+8LKP3nQ54nIaTlC2fOXGKIfAKHANAI0AjQCNAI0AjQCNAI0AjQgEaARoBGgEaARoBGgEaARoBGgAY0AjQCNAI0AjQCNAI0AjQCNKARoBGgEaARoNE/T+EQHL4SwXhsCbnrKWvHU3bdV3rHV3rPlXrPkbqppY5tYXUkVx3JZSo4Z4wxkXa7KukmKul2dDvdd+Mk9ltJ7DeTGNAHXFML+Slnu6slnVkpOfm1og5bttC/8lmp4LwtuGhbzGo40t1kFs7ogyjljNV9ZS9V3OB11Su97XUrWLqJFFtcLEdu9vmRTPSq3+vDHk2oli3k66qXWzie7V8r6AIuxogty+/KbvbxydzActmJcNVNrIYW6uloED0ay4/i9opg64GlH4yHgwe57wL6L/YhtN17k4Xh95HT8z99b0D/xBl891Rx5DDuv4D+AzW1kHMThaFnRzOD//McgP5BT0aD6N5UYYzCLID+Th/ztnPzXFSr+ypDZSZAf3MvPF/LVw/7rRKgf6NtX9nXZsvjW1krS3E+QDPGXgz64e2ZngnKMxoPfXeqMPh0NBimPqex0G3FxfXZythKSZdMmNdI6B1XWlcu9J1uauGYMrNx0OuBpS9f7JsxbW6joD+EtnvlfHXaxFVMABnQpJZrk5GNgN51pDJxTzYKuiM5v3q+epoh2tA3zkUn91zpgpkw9P3xfHWp4pZBTBj6bcXNUnwCBeivatlCXpstY1+mDn1nuucYWIlDv+z3cm+qbi9YCUO3FRe3zkZTICUOPV8L+8BJHLruKevJiWAEnMSh5ybDI6AkDr2VUfbLAR/LNnXo+Vo4AEbi0E0t5IshH9DUoRdHggiEBkA/rOWPg5A49GpBeynHD+KRh148lsUjSOrQKWfs2dHMEPiIQ28ElgM6A6Df9Ho50BkA/arfw20VdeiUM7ZW1EXQEYduaIl3uk2A3sjhQswI6PWc7YHNAOjNwAK0CdBbGUAbAb3r4RUbI6BbWtpgMwC6rbgFNgOgv/z1DyIOLdJuF2wGQNud7j7YDIB24qQNNgOgM42kCTYDoPO7+w2wGQAd1gFtBHRxuw1oE6AL2/stsBkA7cVJB2w/32c7r8DNq/e3jAAAAABJRU5ErkJggg==

### Instruction
Copy the files to the project folder "*protected*" and, depending on your OS, run migrator or migrator.bat

After starting, a directory with migrations and migration files with existing databases and all tables in them will be created. 

**Social Media:**

Twitter: <http://www.twitter.com/jdayamx>

Facebook: <http://www.facebook.com/jdayamx>