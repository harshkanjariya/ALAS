#!/bin/bash
if [ -f $1 ];
then
	f=$1;
	b=`basename $f`;
	d=`dirname $f`;
	e=${b##*.};
	if [ $e = "cpp" ]
	then
		n=${b%.cpp};
		emcc --bind -o "$d/$n.js" $f
	else
		echo "Not a c++ file";
	fi
else
	contain=1;
	for f in $1/*;
	do
		if [ -f $f ]; then
			b=`basename $f`;
			e=${b##*.};
			if [ "$e" = "cpp" ];
			then
				contain=0;
				n=${b%.cpp};
				emcc --bind -o "$1/$n.js" $f
			fi
		fi
	done
	if [ $contain = 1 ]
	then
		echo "No cpp file found";
	fi
fi
