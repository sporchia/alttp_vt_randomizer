### Structure of edge definition files

`This data is probably not completely correct...`

The idea of the structure of the edge data files is that they're split into 4 distinct categories

1. Base edges - These are edges that will always exist regardless of the game's settings and will be the same regardless of world state. One file for each world, and a file for each dungeon.

2. Glitched edges - These will define edges created when enabling logic for specific glitches. One file for overworld glitches, another for underworld glitches.

3. Inverted - These are edges that exist for inverted world state. One file for each world. Dungeons are generally not affected by Inverted world state.

4. Standard - These are edges that exist only in the open and standard world state. One file for each world.

It will be the origin node of the edge that will determine what file in is in. For example, if you have an edge that leads from the outside of Eastern Palace into Eastern Palace's lobby, that edge would exist in the `base/lightworld.yml`, not `base/dungeons/eastern_palace.yml`, as the origin node is what defines what file it is in. This would be an directed edge. Another directed edge could be defined in `base/dungeons/eastern_palace.yml` that'll also be directed and go back outside.
