package org.kanthaka.cassandra.bulkloader;
/**
 * Created with IntelliJ IDEA.
 * User: pushpalanka
 * Date: 6/5/12
 * Time: 4:58 PM
 * To change this template use File | Settings | File Templates.
 */

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.nio.ByteBuffer;
import java.util.UUID;

import org.apache.cassandra.db.marshal.AsciiType;
import org.apache.cassandra.dht.IPartitioner;
import org.apache.cassandra.dht.RandomPartitioner;
import org.apache.cassandra.io.sstable.SSTableSimpleUnsortedWriter;

import static org.apache.cassandra.utils.ByteBufferUtil.bytes;
import static org.apache.cassandra.utils.UUIDGen.decompose;

public class SSTableGenerator {

		static String filename;

		public static void main(String[] args) throws IOException {

				if (args.length == 0)
				        {
				            System.out.println("Expecting <csv_file> as argument");
				            System.exit(1);
				        }
				filename = args[0];
				BufferedReader reader = new BufferedReader(new FileReader(filename));

				String keySpace = "CDRs";
				File directory = new File(keySpace);
				if(!directory.exists()){
						directory.mkdir();
				}

				IPartitioner partitioner = new RandomPartitioner();

				SSTableSimpleUnsortedWriter eventWriter = new SSTableSimpleUnsortedWriter(
						directory, partitioner, keySpace, "Events", AsciiType.instance,
						null, 64);

				String line;
				int lineNumber = 1;
				CsvEntry entry = new CsvEntry();

				long timestamp = System.currentTimeMillis() * 1000;
				while((line = reader.readLine()) != null){
						if(entry.parse(line, lineNumber)){
								ByteBuffer uuid = ByteBuffer
										.wrap(decompose(entry.CorrelationID));

								System.out.println(uuid);

								eventWriter.newRow(uuid);
								eventWriter.addColumn(bytes("sourceAdd"),bytes(entry.sourceAdd), timestamp);
								eventWriter.addColumn(bytes("sourceChannelType"),bytes(entry.sourceChannelType), timestamp);
								eventWriter.addColumn(bytes("desAdd"), bytes(entry.desAdd),timestamp);
								eventWriter.addColumn(bytes("desChannelType"),bytes(entry.desChannelType), timestamp);
								eventWriter.addColumn(bytes("transStatus"),bytes(entry.transStatus), timestamp);
						}
						lineNumber++;
				}

				eventWriter.close();

				System.exit(0);
		}


		static class CsvEntry {

				UUID CorrelationID;
				String id;
				String sourceAdd;
				String sourceChannelType;
				String desAdd;
				String desChannelType;
				String transStatus;

				boolean parse(String line, int lineNumber) {

						String[] columns = line.split(",");
						System.out.println(columns.length);
						if(columns.length != 48){
								System.out.println(String.format(
										"Invalid input '%s' at line %d of %s", line,
										lineNumber, filename));
								return false;
						}
						try {

								CorrelationID = UUID.randomUUID();
								id = columns[0].trim();
								sourceAdd = columns[8].trim();
								sourceChannelType = columns[10].trim();
								desAdd = columns[12].trim();
								desChannelType = columns[14].trim();
								transStatus = columns[29].trim();

								return true;
						}
						catch(NumberFormatException e) {
								System.out.println(String.format(
										"Invalid number in input '%s' at line %d of %s", line,
										lineNumber, filename));
								return false;
						}
				}
		}


}