import re
import MySQLdb as mdb
from sqlalchemy import create_engine

import pandas as pd
import numpy as np

# engine = create_engine("mysql://USER:PASSWORD@HOST/DATABASE")
from typing import List

engine = create_engine("mysql://root:@localhost/movielensdata")


def raw_dataframe(names, file_name, dtypes):
	df = pd.read_csv(file_name, sep="::", names=names, dtype=dtypes)
	return df


def export_dataframe_ratingstable():
	names = ['UserID', 'MovieID', 'Rating', 'Timestamp']
	dtypes = {'UserID': np.int32, 'MovieID': np.int32, 'Rating': np.float32, 'Timestamp': str}
	df = raw_dataframe(names, 'data\\ratings.dat', dtypes)
	print(df.head())
	df.to_sql('ratings', engine, if_exists='fail')
	print("Ratings table created and data imported")
	print()


def export_dataframe_userstable():
	names = ['UserID', 'Gender', 'Age', 'Occupation', 'Zip_Code']  # type: List[str]
	dtypes = {'UserID': np.int32, 'Gender': str, 'Age': np.int32, 'Occupation': np.int32, 'Zip_Code': str}

	dictOccupation = {
		0:  'other',
		1:  'academic/educator',
		2:  'artist',
		3:  'clerical/admin',
		4:  'college/grad student',
		5:  'customer service',
		6:  'doctor/health care',
		7:  'executive/managerial',
		8:  'farmer',
		9:  'homemaker',
		10:  'K-12 student',
		11:  'lawyer',
		12:  'programmer',
		13:  'retired',
		14:  'sales/marketing',
		15:  'scientist',
		16:  'self-employed',
		17:  'technician/engineer',
		18:  'tradesman/craftsman',
		19:  'unemployed',
		20:  'writer'
	}

	df = raw_dataframe(names, 'data\\users.dat', dtypes)
	df.Occupation.replace(to_replace=dictOccupation, inplace=True)
	print(df.head())
	df.to_sql('users', engine, if_exists='fail')
	print("Users table created and data imported")
	print()


def export_dataframe_moviestable():
	names = ['MovieID', 'Title', 'Genres']
	dtypes = {'MovieID': np.int32, 'Title': str, 'Genres': str}
	df = raw_dataframe(names, 'data\\movies.dat', dtypes)
	print(df.head())

	rTitle = [re.split('\(', title)[0] for title in df.Title]
	rTitle = [t.split(',')[0] for t in rTitle]
	print(rTitle)
	df['rTitle'] = rTitle

	years = [int(title[title.rfind("(") + 1:title.rfind(")")]) for title in df.Title]
	df['YearReleased'] = years

	print(df.head())

	df.to_sql('movies', engine, if_exists='fail')
	print("Movies table created and data imported")
	print()


def insert_categories_into_movies():
	try:
		con = mdb.connect('localhost', 'root', '', 'movielensdata')
		# con = mdb.connect('localhost', 'root', '', 'movielensdata', charset='utf8')

		cur = con.cursor()

		# GET ALL RECORDS OF GENRE_CATEGORY
		cur.execute("SELECT gc_id, gc_title FROM genre_cate")

		rows = cur.fetchall()

		gc = {};
		for row in rows:
			gc[row[1]] = row[0]

		print(gc); print()

		# GET MOVIEID AND GENRE FROM MOVIES TABLE
		cur.execute("SELECT movieid, genres FROM MOVIES")
		rows = cur.fetchall()

		moviecat = {};
		for row in rows:
			genres = row[1].split("|")

			strID = ""
			for g in genres:
				strID = strID + str(gc[g]) + ","

			moviecat[row[0]] = strID.rstrip(',')

		print()
		print(moviecat)

		with con:

			cur = con.cursor()

			for key in moviecat:
				sql = "UPDATE movies SET categories ='%s' WHERE movieid = %d" % (moviecat[key], key)
				# print(sql)
				cur.execute(sql)

			con.commit()

	finally:

		if con:
			con.close()



def main():
	print("Welcome to Data Extractor Segment. Here, data are exported from files to mysql tables")

	# export_dataframe_ratingstable()
	# export_dataframe_userstable()
	# export_dataframe_moviestable()
	insert_categories_into_movies()

if __name__ == '__main__':
	main()
