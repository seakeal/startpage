import os

dir_path = ''

table = ''
sql = f"INSERT INTO {table}\n(PATH, TITLE)\nVALUES"
i = 1

for f in os.listdir(dir_path):
    next_q = f"('{f}', 'untitled {i}'),\n"
    sql += next_q
    i += 1

with open('insert_new.sql', 'w') as sqlfile:
    sqlfile.write(sql)